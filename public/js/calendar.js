const daysTag = document.querySelector(".days"),
    currentDate = document.querySelector(".current-date"),
    prevNextIcon = document.querySelectorAll(".icons span"),
    employeeButtons = document.querySelectorAll(".btn-check");

let selectedDate = new Date(); // Initialise à la date actuelle

let date = new Date(),
    currYear = date.getFullYear(),
    currMonth = date.getMonth();

const months = ["January", "February", "March", "April", "May", "June", "July",
    "August", "September", "October", "November", "December"];

const fetchInitialAvailability = async (year, month) => {
    try {
        let response = await fetch(`/calendar/initial-availability?year=${year}&month=${month + 1}`);
        let data = await response.json();
        return data;
    } catch (error) {
        console.error('Erreur lors de la récupération des données de disponibilité initiale:', error);
        return {};
    }
};

const fetchEmployeeAvailability = async (year, month, employeeIds) => {
    try {
        let response = await fetch(`/calendar/employee-availability?year=${year}&month=${month + 1}&employees=${employeeIds.join(',')}`);
        let data = await response.json();
        return data;
    } catch (error) {
        console.error('Erreur lors de la récupération des données de disponibilité des employés:', error);
        return {};
    }
};

document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.prestation-select .btn-check').forEach(checkbox => {
        checkbox.addEventListener('change', loadAvailableSlots);
    });

    document.querySelectorAll('.employee-select .btn-check').forEach(checkbox => {
        checkbox.addEventListener('change', () => {
            renderCalendar();
            loadAvailableSlots();
        });
    });

    document.querySelectorAll('.user-select .btn-check').forEach(checkbox => {
        checkbox.addEventListener('change', loadAvailableSlots);
    });

    // Bouton pour ouvrir la modal de création de nouvel utilisateur
    document.getElementById('add-user-btn').addEventListener('click', () => {
        $('#addUserModal').modal('show');
    });

    // Soumission du formulaire de création de nouvel utilisateur
    document.getElementById('add-user-form').addEventListener('submit', async (e) => {
        e.preventDefault();

        const userName = document.getElementById('user-name').value;
        const userEmail = document.getElementById('user-email').value;

        const jwtToken = document.cookie.split('; ').find(row => row.startsWith('jwt_token=')).split('=')[1];


        try {
            let response = await fetch('/temporary-users/create', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Authorization': `Bearer ${jwtToken}` // Ajouter le token JWT dans les en-têtes
                },
                body: JSON.stringify({
                    name: userName,
                    email: userEmail
                })
            });

            if (!response.ok) {
                const errorData = await response.json();
                throw new Error(errorData.error || 'Échec de la création de l\'utilisateur');
            }

            let newUser = await response.json();

            // Ajouter le nouvel utilisateur temporaire à la liste déroulante
            let userSelect = document.getElementById('user-select');
            let option = document.createElement('option');
            option.value = `temporary-${newUser.id}`;
            option.text = newUser.name;
            userSelect.add(option);
            userSelect.value = `temporary-${newUser.id}`;

            Swal.fire('Succès', 'Utilisateur créé avec succès', 'success');

            $('#addUserModal').modal('hide');
        } catch (error) {
            console.error('Erreur lors de la création de l\'utilisateur:', error);
            Swal.fire('Erreur', error.message, 'error');
        }
    });

    renderCalendar();
    loadAvailableSlots(); // Charger les créneaux disponibles directement
});

const renderCalendar = async () => {
    let firstDayofMonth = new Date(currYear, currMonth, 1).getDay(),
        lastDateofMonth = new Date(currYear, currMonth + 1, 0).getDate(),
        lastDayofMonth = new Date(currYear, currMonth, lastDateofMonth).getDay(),
        lastDateofLastMonth = new Date(currYear, currMonth, 0).getDate();
    let liTag = "";

    const employeeIds = Array.from(document.querySelectorAll('.employee-select .btn-check:checked')).map(btn => btn.dataset.id);

    const availability = employeeIds.length > 0 ?
        await fetchEmployeeAvailability(currYear, currMonth, employeeIds) :
        await fetchInitialAvailability(currYear, currMonth);

    for (let i = firstDayofMonth; i > 0; i--) {
        liTag += `<li class="inactive">${lastDateofLastMonth - i + 1}</li>`;
    }

    for (let i = 1; i <= lastDateofMonth; i++) {
        let isToday = i === date.getDate() && currMonth === new Date().getMonth()
        && currYear === new Date().getFullYear() ? "active" : "";

        let dayClass = availability[i] ? "available" : "unavailable";

        let selected = selectedDate.getDate() === i && currMonth === selectedDate.getMonth()
        && currYear === selectedDate.getFullYear() ? "selected" : "";

        liTag += `<li class="${isToday} ${dayClass} ${selected}" data-date="${currYear}-${String(currMonth + 1).padStart(2, '0')}-${String(i).padStart(2, '0')}"><div class="number">${i}</div></li>`;
    }

    for (let i = lastDayofMonth; i < 6; i++) {
        liTag += `<li class="inactive">${i - lastDayofMonth + 1}</li>`;
    }
    currentDate.innerText = `${months[currMonth]} ${currYear}`;
    daysTag.innerHTML = liTag;

    document.querySelectorAll('.days li').forEach(day => {
        day.addEventListener('click', function() {
            selectedDate = new Date(this.dataset.date);
            document.querySelectorAll('.days li').forEach(d => d.classList.remove('selected'));
            this.classList.add('selected');
            loadAvailableSlots();
        });
    });

    loadAvailableSlots();
};

const loadAvailableSlots = async () => {
    if (!selectedDate) return;

    const userId = document.querySelector('#user-select').value;
    const employeeIds = Array.from(document.querySelectorAll('.employee-select .btn-check:checked')).map(btn => btn.dataset.id);
    const prestationIds = Array.from(document.querySelectorAll('.prestation-select .btn-check:checked')).map(btn => btn.dataset.id);

    if (employeeIds.length === 0) {
        document.getElementById('slots-container').innerHTML = '';
        return;
    }

    try {
        let response = await fetch(`/calendar/slots?date=${selectedDate.toISOString().split('T')[0]}&user=${userId}&employees=${employeeIds.join(',')}&prestations=${prestationIds.join(',')}`);
        if (!response.ok) {
            throw new Error('La réponse du serveur n\'était pas correcte');
        }
        let slots = await response.json();

        let slotsContainer = document.getElementById('slots-container');
        slotsContainer.innerHTML = '';

        slots.forEach(slot => {
            let slotElement = document.createElement('div');
            slotElement.className = 'btn btn-success m-1';
            slotElement.innerText = `${slot.time} - ${slot.employee}`;
            slotElement.addEventListener('click', () => confirmAppointment(slot));
            slotsContainer.appendChild(slotElement);
        });
    } catch (error) {
        console.error('Erreur lors de la récupération des créneaux disponibles:', error);
    }
};

const confirmAppointment = async (slot) => {
    const userId = document.querySelector('#user-select').value;
    const employeeName  = slot.employee;
    const prestationNames = Array.from(document.querySelectorAll('.prestation-select .btn-check:checked')).map(btn => btn.nextElementSibling.innerText);

    const userName = userId ? document.querySelector(`#user-select option[value="${userId}"]`).text : 'Non sélectionné';

    if (!userId || prestationNames.length === 0) {
        Swal.fire({
            title: 'Erreur',
            text: 'Veuillez sélectionner un utilisateur et une prestation avant de prendre rendez-vous.',
            icon: 'error',
            confirmButtonText: 'OK'
        });
        return;
    }

    const confirmationHtml = `
        <p><strong>Utilisateur :</strong> ${userName}</p>
        <p><strong>Employés :</strong> ${employeeName}</p>
        <p><strong>Prestations :</strong> ${prestationNames.join(', ')}</p>
        <p><strong>Date :</strong> ${selectedDate.toISOString().split('T')[0]}</p>
        <p><strong>Heure :</strong> ${slot.time}</p>
    `;

    Swal.fire({
        title: 'Confirmer le Rendez-vous',
        html: confirmationHtml,
        icon: 'info',
        showCancelButton: true,
        confirmButtonText: 'Confirmer',
        cancelButtonText: 'Annuler'
    }).then((result) => {
        if (result.isConfirmed) {
            bookAppointment(slot);
        }
    });
};

const bookAppointment = async (slot) => {
    const userId = document.querySelector('#user-select').value;
    const employeeIds = Array.from(document.querySelectorAll('.employee-select .btn-check:checked')).map(btn => btn.dataset.id);
    const prestationIds = Array.from(document.querySelectorAll('.prestation-select .btn-check:checked')).map(btn => btn.dataset.id);

    // Récupérer le token JWT depuis le cookie
    const jwtToken = document.cookie.split('; ').find(row => row.startsWith('jwt_token=')).split('=')[1];

    try {
        let response = await fetch(`/calendar/book`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Authorization': `Bearer ${jwtToken}` // Ajouter le token JWT dans les en-têtes
            },
            body: JSON.stringify({
                date: selectedDate.toISOString().split('T')[0],
                time: slot.time,
                user: userId,
                employees: employeeIds,
                prestations: prestationIds
            })
        });
        if (!response.ok) {
            // Lire la réponse JSON pour obtenir des détails sur l'erreur
            const errorData = await response.json();
            throw new Error(errorData.message || 'Failed to book appointment');
        }
        Swal.fire('Success!', 'Appointment booked successfully!', 'success');
        loadAvailableSlots();
    } catch (error) {
        console.error('Error booking appointment:', error);
        Swal.fire('Error', error.message || 'Failed to book appointment', 'error');
    }
};

document.querySelectorAll('.prestation-select .btn-check').forEach(checkbox => {
    checkbox.addEventListener('change', loadAvailableSlots);
});

document.querySelectorAll('.employee-select .btn-check').forEach(checkbox => {
    checkbox.addEventListener('change', () => {
        renderCalendar();
        loadAvailableSlots();
    });
});

document.querySelectorAll('.user-select .btn-check').forEach(checkbox => {
    checkbox.addEventListener('change', loadAvailableSlots);
});

renderCalendar();

prevNextIcon.forEach(icon => {
    icon.addEventListener("click", () => {
        currMonth = icon.id === "prev" ? currMonth - 1 : currMonth + 1;

        if (currMonth < 0 || currMonth > 11) {
            date = new Date(currYear, currMonth, new Date().getDate());
            currYear = date.getFullYear();
            currMonth = date.getMonth();
        } else {
            date = new Date();
        }
        renderCalendar();
    });
});

employeeButtons.forEach(button => {
    button.addEventListener('change', function() {
        loadAvailableSlots();
    });
});
