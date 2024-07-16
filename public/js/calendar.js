const daysTag = document.querySelector(".days"),
    currentDate = document.querySelector(".current-date"),
    prevNextIcon = document.querySelectorAll(".icons span"),
    employeeButtons = document.querySelectorAll(".btn-check");

let selectedDate = new Date(); // Initialise à la date actuelle

// getting new date, current year and month
let date = new Date(),
    currYear = date.getFullYear(),
    currMonth = date.getMonth();

// storing full name of all months in array
const months = ["January", "February", "March", "April", "May", "June", "July",
    "August", "September", "October", "November", "December"];

const fetchAvailability = async (year, month) => {
    try {
        let response = await fetch(`/calendar/availability?year=${year}&month=${month + 1}`);
        let data = await response.json();
        return data;
    } catch (error) {
        console.error('Error fetching availability data:', error);
        return {};
    }
};

const renderCalendar = async () => {
    let firstDayofMonth = new Date(currYear, currMonth, 1).getDay(), // getting first day of month
        lastDateofMonth = new Date(currYear, currMonth + 1, 0).getDate(), // getting last date of month
        lastDayofMonth = new Date(currYear, currMonth, lastDateofMonth).getDay(), // getting last day of month
        lastDateofLastMonth = new Date(currYear, currMonth, 0).getDate(); // getting last date of previous month
    let liTag = "";

    const availability = await fetchAvailability(currYear, currMonth);

    for (let i = firstDayofMonth; i > 0; i--) { // creating li of previous month last days
        liTag += `<li class="inactive">${lastDateofLastMonth - i + 1}</li>`;
    }

    for (let i = 1; i <= lastDateofMonth; i++) { // creating li of all days of current month
        let isToday = i === date.getDate() && currMonth === new Date().getMonth()
        && currYear === new Date().getFullYear() ? "active" : "";

        let dayClass = availability[i] ? "available" : "unavailable";

        let selected = selectedDate.getDate() === i && currMonth === selectedDate.getMonth()
        && currYear === selectedDate.getFullYear() ? "selected" : "";

        liTag += `<li class="${isToday} ${dayClass} ${selected}" data-date="${currYear}-${String(currMonth + 1).padStart(2, '0')}-${String(i).padStart(2, '0')}"><div class="number">${i}</div></li>`;
    }

    for (let i = lastDayofMonth; i < 6; i++) { // creating li of next month first days
        liTag += `<li class="inactive">${i - lastDayofMonth + 1}</li>`
    }
    currentDate.innerText = `${months[currMonth]} ${currYear}`; // passing current mon and yr as currentDate text
    daysTag.innerHTML = liTag;

    // Attach click event to day elements
    document.querySelectorAll('.days li').forEach(day => {
        day.addEventListener('click', function() {
            selectedDate = new Date(this.dataset.date);
            document.querySelectorAll('.days li').forEach(d => d.classList.remove('selected'));
            this.classList.add('selected');
            loadAvailableSlots();
        });
    });

    loadAvailableSlots(); // Load slots for the initial selected date
};

const loadAvailableSlots = async () => {
    if (!selectedDate) return;

    const userId = document.querySelector('input[name="user"]:checked')?.dataset.id;
    const employeeIds = Array.from(document.querySelectorAll('.employee-select .btn-check:checked')).map(btn => btn.dataset.id);
    const prestationIds = Array.from(document.querySelectorAll('.prestation-select .btn-check:checked')).map(btn => btn.dataset.id);

    if (!userId || employeeIds.length === 0 || prestationIds.length === 0) {
        document.getElementById('slots-container').innerHTML = ''; // Clear slots if no user, employees or prestations are selected
        return;
    }

    try {
        let response = await fetch(`/calendar/slots?date=${selectedDate.toISOString().split('T')[0]}&user=${userId}&employees=${employeeIds.join(',')}&prestations=${prestationIds.join(',')}`);
        if (!response.ok) {
            throw new Error('Server response was not ok');
        }
        let slots = await response.json();

        let slotsContainer = document.getElementById('slots-container');
        slotsContainer.innerHTML = '';

        slots.forEach(slot => {
            let slotElement = document.createElement('div');
            slotElement.className = 'badge badge-success m-1';
            slotElement.innerText = `${slot.time} - ${slot.employee}`;
            slotElement.addEventListener('click', () => bookAppointment(slot));
            slotsContainer.appendChild(slotElement);
        });
    } catch (error) {
        console.error('Error fetching available slots:', error);
    }
};

const bookAppointment = async (slot) => {
    const userId = document.querySelector('input[name="user"]:checked')?.dataset.id;
    const employeeIds = Array.from(document.querySelectorAll('.employee-select .btn-check:checked')).map(btn => btn.dataset.id);
    const prestationIds = Array.from(document.querySelectorAll('.prestation-select .btn-check:checked')).map(btn => btn.dataset.id);

    try {
        let response = await fetch(`/calendar/book`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
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
            throw new Error('Failed to book appointment');
        }
        alert('Appointment booked successfully!');
        loadAvailableSlots(); // Refresh slots after booking
    } catch (error) {
        console.error('Error booking appointment:', error);
        alert('Failed to book appointment');
    }
};


document.querySelectorAll('.prestation-select .btn-check').forEach(checkbox => {
    checkbox.addEventListener('change', loadAvailableSlots);
});

document.querySelectorAll('.employee-select .btn-check').forEach(checkbox => {
    checkbox.addEventListener('change', loadAvailableSlots);
});

document.querySelectorAll('.user-select .btn-check').forEach(checkbox => {
    checkbox.addEventListener('change', loadAvailableSlots);
});

renderCalendar();

prevNextIcon.forEach(icon => { // getting prev and next icons
    icon.addEventListener("click", () => { // adding click event on both icons
        currMonth = icon.id === "prev" ? currMonth - 1 : currMonth + 1;

        if (currMonth < 0 || currMonth > 11) { // if current month is less than 0 or greater than 11
            date = new Date(currYear, currMonth, new Date().getDate());
            currYear = date.getFullYear(); // updating current year with new date year
            currMonth = date.getMonth(); // updating current month with new date month
        } else {
            date = new Date(); // pass the current date as date value
        }
        renderCalendar(); // calling renderCalendar function
    });
});

employeeButtons.forEach(button => {
    button.addEventListener('change', function() {
        loadAvailableSlots();
    });
});
