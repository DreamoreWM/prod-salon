<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <title>Dynamic Calendar JavaScript</title>
    <link rel="stylesheet" href="{{ asset('css/calendar.css') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Google Font Link for Icons -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="{{ asset('js/calendar.js') }}" defer></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
<div class="wrapper">
    <header>
        <p class="current-date"></p>
        <div class="icons">
            <span id="prev" class="material-symbols-rounded">chevron_left</span>
            <span id="next" class="material-symbols-rounded">chevron_right</span>
        </div>
    </header>
    <div class="calendar">
        <ul class="weeks">
            <li>Sun</li>
            <li>Mon</li>
            <li>Tue</li>
            <li>Wed</li>
            <li>Thu</li>
            <li>Fri</li>
            <li>Sat</li>
        </ul>
        <ul class="days"></ul>
    </div>
    <div class="employee-select">
        <h3>Select Employees:</h3>
        <div id="employee-buttons" class="btn-group" role="group">
            @foreach(App\Models\Employee::all() as $employee)
                <input type="checkbox" class="btn-check" id="employee-{{ $employee->id }}" data-id="{{ $employee->id }}" autocomplete="off">
                <label class="btn btn-outline-primary" for="employee-{{ $employee->id }}">{{ $employee->name }}</label>
            @endforeach
        </div>
    </div>
    <div id="available-slots" class="mt-3">
        <h3>Available Slots</h3>
        <div id="slots-container"></div>
    </div>
</div>
</body>
</html>
