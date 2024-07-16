<div>
    <div class="container py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <form method="POST" action="{{ route('employees.slots.update', $employee->id) }}">
                @csrf
                @method('PUT')

                <label for="day_of_week">Jour de la semaine :</label>
                <select id="day_of_week" name="day_of_week" required>
                    <option value="1">Lundi</option>
                    <option value="2">Mardi</option>
                    <option value="3">Mercredi</option>
                    <option value="4">Jeudi</option>
                    <option value="5">Vendredi</option>
                    <option value="6">Samedi</option>
                    <option value="7">Dimanche</option>
                </select>

                <label for="start_time">Heure de début :</label>
                <input type="time" id="start_time" name="start_time" required>

                <label for="end_time">Heure de fin :</label>
                <input type="time" id="end_time" name="end_time" required>

                <button type="submit">Enregistrer les créneaux</button>
            </form>

        </div>
    </div>


    <script>
        function toggleRow(checkbox) {
            const cells = checkbox.closest('tr').querySelectorAll('input[type=checkbox]');
            cells.forEach(cell => {
                cell.checked = checkbox.checked;
            });
        }

        function toggleAll(globalCheckbox, tableId) {
            const table = document.getElementById(tableId);
            const checkboxes = table.querySelectorAll('input[type=checkbox]');
            checkboxes.forEach(checkbox => {
                checkbox.checked = globalCheckbox.checked;
            });
        }
    </script>{-- If your happiness depends on money, you will never be happy with yourself. --}}
</div>
