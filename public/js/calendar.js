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
    loadAppointments(); // Charger les rendez-vous pour la date sélectionnée
});

// Couleurs pour les cartes des employés
const employeeColors = [
    'bg-primary', 'bg-secondary', 'bg-success', 'bg-danger', 'bg-warning', 'bg-info', 'bg-light', 'bg-dark'
];

// Charger les rendez-vous en fonction de la date sélectionnée
const loadAppointments = async () => {
    if (!selectedDate) return;

    try {
        let response = await fetch(`/calendar/appointments?date=${selectedDate.toISOString().split('T')[0]}`);
        if (!response.ok) {
            throw new Error('La réponse du serveur n\'était pas correcte');
        }
        let appointments = await response.json();

        const employeeIds = Array.from(document.querySelectorAll('.employee-select .btn-check:checked')).map(btn => parseInt(btn.dataset.id));
        if (employeeIds.length > 0) {
            appointments = appointments.filter(appointment => employeeIds.includes(appointment.employee.id));
        }

        appointments.sort((a, b) => new Date(a.start_time) - new Date(b.start_time));

        let appointmentsByEmployee = {};
        appointments.forEach(appointment => {
            if (!appointmentsByEmployee[appointment.employee.id]) {
                appointmentsByEmployee[appointment.employee.id] = [];
            }
            appointmentsByEmployee[appointment.employee.id].push(appointment);
        });

        const availableSlots = await fetchAvailableSlots();
        availableSlots.forEach(slot => {
            const employeeId = slot.employee_id;
            if (!appointmentsByEmployee[employeeId]) {
                appointmentsByEmployee[employeeId] = [];
            }
            appointmentsByEmployee[employeeId].push({
                start_time: selectedDate.toISOString().split('T')[0] + ' ' + slot.time,
                end_time: selectedDate.toISOString().split('T')[0] + ' ' + slot.time,
                employee: { id: employeeId, name: slot.employee },
                prestations: [],
                client: 'Libre'
            });
        });

        Object.keys(appointmentsByEmployee).forEach(employeeId => {
            appointmentsByEmployee[employeeId].sort((a, b) => new Date(a.start_time) - new Date(b.start_time));
        });

        generateAppointmentsTable(appointmentsByEmployee);

    } catch (error) {
        console.error('Erreur lors de la récupération des rendez-vous:', error);
    }
};

const fetchAvailableSlots = async () => {
    const userId = document.querySelector('#user-select').value;
    const employeeIds = Array.from(document.querySelectorAll('.employee-select .btn-check:checked')).map(btn => btn.dataset.id);
    const prestationIds = Array.from(document.querySelectorAll('.prestation-select .btn-check:checked')).map(btn => btn.dataset.id);

    try {
        let response = await fetch(`/calendar/slots?date=${selectedDate.toISOString().split('T')[0]}&user=${userId}&employees=${employeeIds.join(',')}&prestations=${prestationIds.join(',')}`);
        if (!response.ok) {
            throw new Error('La réponse du serveur n\'était pas correcte');
        }
        return await response.json();
    } catch (error) {
        console.error('Erreur lors de la récupération des créneaux disponibles:', error);
        return [];
    }
};


const generateAppointmentsTable = (appointmentsByEmployee) => {
    let tableContainer = document.getElementById('appointments-table-container');
    if (!tableContainer) {
        console.error('Element appointments-table-container non trouvé');
        return;
    }

    let table = document.createElement('table');
    table.className = 'table table-bordered';

    let thead = document.createElement('thead');
    let headerRow = document.createElement('tr');

    Object.keys(appointmentsByEmployee).forEach(employeeId => {
        let th = document.createElement('th');
        th.textContent = appointmentsByEmployee[employeeId][0].employee.name;
        headerRow.appendChild(th);
    });

    thead.appendChild(headerRow);
    table.appendChild(thead);

    let tbody = document.createElement('tbody');

    let maxAppointments = Math.max(...Object.values(appointmentsByEmployee).map(a => a.length));

    for (let i = 0; i < maxAppointments; i++) {
        let row = document.createElement('tr');

        Object.keys(appointmentsByEmployee).forEach(employeeId => {
            let td = document.createElement('td');

            if (appointmentsByEmployee[employeeId][i]) {
                let appointment = appointmentsByEmployee[employeeId][i];
                let startTime = new Date(appointment.start_time);
                let endTime = new Date(appointment.end_time);

                let formattedStartTime = startTime.toLocaleTimeString('fr-FR', {
                    hour: '2-digit',
                    minute: '2-digit'
                });

                let formattedEndTime = endTime.toLocaleTimeString('fr-FR', {
                    hour: '2-digit',
                    minute: '2-digit'
                });

                let isAvailable = appointment.client === 'Libre';
                td.innerHTML = `
                    <div class="card ${isAvailable ? 'bg-success' : employeeColors[Object.keys(appointmentsByEmployee).indexOf(employeeId) % employeeColors.length]} text-dark">
                        <div class="card-body">
                            <span class="badge badge-primary">${formattedStartTime} à ${formattedEndTime}</span>
                            <span class="badge ${isAvailable ? 'badge-secondary' : 'badge-primary'}">Client : ${appointment.client}</span>
                        </div>
                    </div>
                `;
            }

            row.appendChild(td);
        });

        tbody.appendChild(row);
    }

    table.appendChild(tbody);
    tableContainer.innerHTML = '';
    tableContainer.appendChild(table);
};




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
            loadAppointments(); // Charger les rendez-vous pour la date sélectionnée
        });
    });

    loadAvailableSlots();
    loadAppointments();
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
            slotElement.innerHTML = `
                    <div class="card bg-success text-dark">
                        <div class="card-body">
                            <span class="badge badge-primary">${slot.time} - ${slot.employee}</span>
                        </div>
                    </div>`;
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
                employees:  [slot.employee_id.toString()],
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
        loadAppointments(); // Recharger les rendez-vous après la réservation
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
