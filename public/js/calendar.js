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

const moisFrancais = ["Janvier", "Février", "Mars", "Avril", "Mai", "Juin", "Juillet",
    "Août", "Septembre", "Octobre", "Novembre", "Décembre"];

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
        checkbox.addEventListener('change', loadAppointments);
    });

    document.querySelectorAll('.employee-select .btn-check').forEach(checkbox => {
        checkbox.addEventListener('change', () => {
            renderCalendar();
        });
    });

    document.querySelectorAll('.user-select .btn-check').forEach(checkbox => {
        checkbox.addEventListener('change', loadAppointments);
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
            option.value = `${newUser.id}`;
            option.text = newUser.name;
            userSelect.add(option);
            userSelect.value = `${newUser.id}`;

            Swal.fire('Succès', 'Utilisateur créé avec succès', 'success');

            $('#addUserModal').modal('hide');
        } catch (error) {
            console.error('Erreur lors de la création de l\'utilisateur:', error);
            Swal.fire('Erreur', error.message, 'error');
        }
    });

    renderCalendar();
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

        let appointmentsByEmployee = {};

        // Ajouter tous les employés sélectionnés dans appointmentsByEmployee même s'ils n'ont pas de rendez-vous
        employeeIds.forEach(id => {
            appointmentsByEmployee[id] = [];
        });

        appointments = appointments.filter(appointment => employeeIds.includes(appointment.employee.id));
        appointments.sort((a, b) => new Date(a.start_time) - new Date(b.start_time));

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
        let employeeButton = document.querySelector(`.employee-select .btn-check[data-id="${employeeId}"]`);
        let employeeName = employeeButton ? employeeButton.nextElementSibling.textContent : `Employé ${employeeId}`;

        let th = document.createElement('th');
        th.textContent = employeeName;
        headerRow.appendChild(th);
    });

    thead.appendChild(headerRow);
    table.appendChild(thead);

    let tbody = document.createElement('tbody');
    let maxAppointments = Math.max(...Object.values(appointmentsByEmployee).map(a => a.length), 1);

    const now = new Date();

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
                let cardClass = isAvailable ? 'bg-success' : employeeColors[Object.keys(appointmentsByEmployee).indexOf(employeeId) % employeeColors.length];
                let disabledClass = startTime < now ? 'disabled-card' : '';

                let card = document.createElement('div');
                card.className = `card ${cardClass} text-dark ${disabledClass}`;

                if (!isAvailable) {
                    card.innerHTML = `
                        <div class="card-body">
                            <span class="badge badge-primary">${formattedStartTime} à ${formattedEndTime}</span>
                            <span class="badge ${isAvailable ? 'badge-secondary' : 'badge-primary'}">Client : ${appointment.bookable.name}</span>
                            <button class="btn btn-info btn-sm float-right info-prestation" data-appointment-id="${appointment.id}">
                                <i class="fas fa-info-circle"></i>
                            </button>
                            <button class="btn btn-danger btn-sm float-right delete-prestation" data-appointment-id="${appointment.id}" style="margin-right: 5px;">
                                <i class="fas fa-trash"></i>
                            </button>
                            <a href="/loyalty-card/${appointment.bookable.id}" class="btn btn-primary btn-sm float-right loyalty-card" style="margin-right: 5px;">
                                <i class="fas fa-star"></i> Carte de Fidélité
                            </a>
                            <button class="btn btn-success btn-sm float-right complete-appointment" data-appointment-id="${appointment.id}" style="margin-right: 5px;">
                                <i class="fas fa-check"></i> Valider
                            </button>
                        </div>
                    `;
                } else {
                    card.innerHTML = `
                        <div class="card-body">
                            <span class="badge badge-primary">${formattedStartTime}</span>
                            <span class="badge ${isAvailable ? 'badge-secondary' : 'badge-primary'}">Libre</span>
                        </div>
                    `;
                }

                if (!disabledClass && isAvailable) {
                    card.addEventListener('click', () => confirmAppointment({
                        employee_id: employeeId,
                        start_time: startTime.toISOString(),
                        employee: appointment.employee.name
                    }));
                }

                td.appendChild(card);
            } else if (i === 0) {
                let card = document.createElement('div');
                card.className = 'card bg-secondary text-dark';
                card.innerHTML = `
                    <div class="card-body">
                        <span class="badge badge-secondary">Aucun créneau disponible</span>
                    </div>
                `;
                td.appendChild(card);
            }

            row.appendChild(td);
        });

        tbody.appendChild(row);
    }

    table.appendChild(tbody);
    tableContainer.innerHTML = '';
    tableContainer.appendChild(table);

    // Ajouter l'événement de suppression après avoir généré la table
    document.querySelectorAll('.delete-prestation').forEach(button => {
        button.addEventListener('click', function() {
            const appointmentId = this.getAttribute('data-appointment-id');
            Swal.fire({
                title: 'Êtes-vous sûr?',
                text: "Cette action est irréversible!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Oui, supprimer!',
                cancelButtonText: 'Non, annuler!',
            }).then((result) => {
                if (result.isConfirmed) {
                    deletePrestation(appointmentId);
                }
            });
        });
    });

    // Ajouter l'événement pour afficher les détails des prestations
    document.querySelectorAll('.info-prestation').forEach(button => {
        button.addEventListener('click', function() {
            const appointmentId = this.getAttribute('data-appointment-id');
            showPrestationDetails(appointmentId);
        });
    });

    // Ajouter l'événement pour valider le rendez-vous
    document.querySelectorAll('.complete-appointment').forEach(button => {
        button.addEventListener('click', function() {
            const appointmentId = this.getAttribute('data-appointment-id');
            Swal.fire({
                title: 'Confirmer le rendez-vous?',
                text: "Cette action marquera le rendez-vous comme terminé.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Oui, confirmer!',
                cancelButtonText: 'Non, annuler!'
            }).then((result) => {
                if (result.isConfirmed) {
                    completeAppointment(appointmentId);
                }
            });
        });
    });
};

// Fonction pour marquer un rendez-vous comme terminé
const completeAppointment = async (appointmentId) => {
    try {
        const response = await fetch(`/appointments/${appointmentId}/complete`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Content-Type': 'application/json'
            }
        });

        if (response.ok) {
            Swal.fire('Succès', 'Le rendez-vous a été marqué comme terminé.', 'success').then(() => {
                loadAppointments();
            });
        } else {
            Swal.fire('Erreur', 'Une erreur est survenue', 'error');
        }
    } catch (error) {
        Swal.fire('Erreur', 'Une erreur est survenue', 'error');
    }
};



// Fonction pour afficher les détails des prestations
const showPrestationDetails = async (appointmentId) => {
    try {
        const response = await fetch(`/appointments/${appointmentId}/prestations`);
        if (response.ok) {
            const prestations = await response.json();
            let prestationList = prestations.map(p => `<li>${p.nom} - ${p.description} (${p.temps} min)</li>`).join('');
            prestationList = `<ul>${prestationList}</ul>`;

            Swal.fire({
                title: 'Détails des Prestations',
                html: prestationList,
                icon: 'info',
                confirmButtonText: 'Fermer'
            });
        } else {
            Swal.fire('Erreur!', 'Un problème est survenu lors de la récupération des détails.', 'error');
        }
    } catch (error) {
        Swal.fire('Erreur!', 'Un problème est survenu lors de la récupération des détails.', 'error');
    }
};


// Fonction pour supprimer la prestation
const deletePrestation = async (appointmentId) => {

    const jwtToken = document.cookie.split('; ').find(row => row.startsWith('jwt_token=')).split('=')[1];

    try {
        const response = await fetch(`/appointments/${appointmentId}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Authorization': `Bearer ${jwtToken}` // Ajouter le token JWT dans les en-têtes
            }
        });

        if (response.ok) {
            Swal.fire('Supprimé!', 'La prestation a été supprimée.', 'success')
            loadAppointments(); // Recharger les rendez-vous après suppression
        } else {
            Swal.fire('Erreur!', 'Un problème est survenu lors de la suppression.', 'error');
        }
    } catch (error) {
        Swal.fire('Erreur!', 'Un problème est survenu lors de la suppression.', 'error');
    }
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

    const today = new Date(); // Date actuelle

    for (let i = firstDayofMonth; i > 0; i--) {
        liTag += `<li class="inactive">${lastDateofLastMonth - i + 1}</li>`;
    }

    for (let i = 1; i <= lastDateofMonth; i++) {
        let isToday = i === today.getDate() && currMonth === today.getMonth() && currYear === today.getFullYear() ? "active" : "";

        let dayClass = availability[i] ? "available" : "unavailable";

        const currentDay = new Date(currYear, currMonth, i);
        if (currentDay < today && !isToday) {
            dayClass = "past"; // Griser les jours passés
        }

        let selected = selectedDate.getDate() === i && currMonth === selectedDate.getMonth()
        && currYear === selectedDate.getFullYear() ? "selected" : "";

        liTag += `<li class="${isToday} ${dayClass} ${selected}" data-date="${currYear}-${String(currMonth + 1).padStart(2, '0')}-${String(i).padStart(2, '0')}">
                    <div class="number">${i}</div>
                  </li>`;
    }

    for (let i = lastDayofMonth; i < 6; i++) {
        liTag += `<li class="inactive">${i - lastDayofMonth + 1}</li>`;
    }
    currentDate.innerText = `${months[currMonth]} ${currYear}`;
    daysTag.innerHTML = liTag;

    document.querySelectorAll('.days li').forEach(day => {
        if (!day.classList.contains('past')) {
            day.addEventListener('click', function() {
                selectedDate = new Date(this.dataset.date);
                document.querySelectorAll('.days li').forEach(d => d.classList.remove('selected'));
                this.classList.add('selected');
                loadAppointments(); // Charger les rendez-vous pour la date sélectionnée
            });
        }
    });
    loadAppointments();
};




const confirmAppointment = async (slot) => {
    const userId = document.querySelector('#user-select').value;
    const employeeName = slot.employee;
    const prestationElements = Array.from(document.querySelectorAll('.prestation-select .btn-check:checked'));
    const prestationNames = prestationElements.map(btn => btn.nextElementSibling.innerText);
    const prestationDurations = prestationElements.map(btn => parseInt(btn.dataset.duration));

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

    const totalDuration = prestationDurations.reduce((total, duration) => total + duration, 0);
    const startTime = new Date(slot.start_time);
    const endTime = new Date(startTime.getTime() + totalDuration * 60000);

    const formattedStartTime = startTime.toLocaleTimeString('fr-FR', { hour: '2-digit', minute: '2-digit' });

    const confirmationHtml = `
        <p><strong>Utilisateur :</strong> ${userName}</p>
        <p><strong>Employé :</strong> ${employeeName}</p>
        <p><strong>Prestations :</strong> ${prestationNames.join(', ')}</p>
        <p><strong>Date :</strong> ${selectedDate.toISOString().split('T')[0]}</p>
        <p><strong>Heure :</strong> ${formattedStartTime} à ${endTime.toLocaleTimeString('fr-FR', { hour: '2-digit', minute: '2-digit' })}</p>
    `;

    console.log(userId)

    Swal.fire({
        title: 'Confirmer le Rendez-vous',
        html: confirmationHtml,
        icon: 'info',
        showCancelButton: true,
        confirmButtonText: 'Confirmer',
        cancelButtonText: 'Annuler'
    }).then((result) => {
        if (result.isConfirmed) {
            bookAppointment(slot, endTime, formattedStartTime);
        }
    });
};


const bookAppointment = async (slot, endTime, formattedStartTime) => {
    const userSelectElement = document.querySelector('#user-select');
    const userId = userSelectElement.value;
    const bookableType = userSelectElement.options[userSelectElement.selectedIndex].getAttribute('data-type');

    const prestationIds = Array.from(document.querySelectorAll('.prestation-select .btn-check:checked')).map(btn => btn.dataset.id);

    // Récupérer le token JWT depuis le cookie
    const jwtToken = document.cookie.split('; ').find(row => row.startsWith('jwt_token=')).split('=')[1];

    try {
        // Fetch existing appointments for the selected employee and date
        let existingAppointmentsResponse = await fetch(`/calendar/appointments?date=${selectedDate.toISOString().split('T')[0]}&employee=${slot.employee_id}`);
        if (!existingAppointmentsResponse.ok) {
            throw new Error('La réponse du serveur n\'était pas correcte');
        }

        let response = await fetch(`/calendar/book`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Authorization': `Bearer ${jwtToken}` // Ajouter le token JWT dans les en-têtes
            },
            body: JSON.stringify({
                date: selectedDate.toISOString().split('T')[0],
                time: formattedStartTime, // Utiliser l'heure formatée ici
                user: userId,
                type: bookableType,
                employees: [slot.employee_id.toString()],
                prestations: prestationIds
            })
        });

        if (!response.ok) {
            const errorData = await response.json();
            throw new Error(errorData.error || 'Échec de la réservation du rendez-vous');
        }

        Swal.fire('Succès', 'Rendez-vous réservé avec succès', 'success');
        loadAppointments(); // Recharger les rendez-vous après la réservation
    } catch (error) {
        console.error('Erreur lors de la réservation du rendez-vous:', error);
        Swal.fire('Erreur', error.message, 'error');
        loadAppointments();
    }
};




document.querySelectorAll('.prestation-select .btn-check').forEach(checkbox => {
    checkbox.addEventListener('change', loadAppointments);
});

document.querySelectorAll('.employee-select .btn-check').forEach(checkbox => {
    checkbox.addEventListener('change', () => {
        renderCalendar();
        loadAppointments();
    });
});

document.querySelectorAll('.user-select .btn-check').forEach(checkbox => {
    checkbox.addEventListener('change', loadAppointments);
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
        loadAppointments();
    });
});
