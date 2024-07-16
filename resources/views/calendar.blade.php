@extends('layouts.app')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Calendrier') }}
    </h2>
@endsection

@section('content')
    <!DOCTYPE html>
    <html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>Dynamic Calendar JavaScript</title>
        <link rel="stylesheet" href="{{ asset('css/calendar.css') }}">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Google Font Link for Icons -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200">

        <script src="{{ asset('js/calendar.js') }}" defer></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    </head>
    <body>
    <style>
        .collapse {
            visibility: visible;
        }
        .calendar {
            margin-bottom: 20px;
        }
        .accordion-button {
            background-color: transparent !important;
        }
        @media (max-width: 768px) {
            .responsive-calendar {
                display: flex;
                flex-direction: column;
            }
        }
        @media (min-width: 769px) {
            .responsive-calendar {
                display: flex;
                flex-direction: row;
            }
        }
    </style>

    <div class="content py-6 mt-10 pt-10">
        <section class="mt-10">
            <div class="mx-auto max-w-screen-xl lg:px-12">
                <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden">
                    <div class="container">
                        <div class="row responsive-calendar">
                            <div class="col-md-6">
                                <div id="calendar-page" class="wrapper">
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
                                    <div id="available-slots" class="mt-3">
                                        <h3>Available Slots</h3>
                                        <div id="slots-container"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="user-select mt-3">
                                    <h3>Select User:</h3>
                                    <select class="user-select-dropdown form-control" name="user" id="user-select">
                                        <option value="" disabled selected>Select a user</option>
                                        @foreach(App\Models\User::all() as $user)
                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="employee-select mt-3">
                                    <h3>Select Employees:</h3>
                                    <div id="employee-buttons" class="btn-group" role="group">
                                        @foreach(App\Models\Employee::all() as $employee)
                                            <input type="checkbox" class="btn-check" id="employee-{{ $employee->id }}" data-id="{{ $employee->id }}" autocomplete="off">
                                            <label class="btn btn-outline-secondary" for="employee-{{ $employee->id }}">{{ $employee->name }}</label>
                                        @endforeach
                                    </div>
                                </div>

                                <div class="prestation-select mt-3">
                                    <h3>Select Prestations:</h3>
                                    <div class="accordion accordion-flush" id="prestationAccordion">
                                        @foreach($categories as $category)
                                            @php
                                                $accordionId = 'prestationAccordion-' . $category->id;
                                                $headingId = 'heading-' . $category->id;
                                                $collapseId = 'collapse-' . $category->id;
                                            @endphp
                                            <div class="accordion-item">
                                                <h2 class="accordion-header" id="{{ $headingId }}">
                                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#{{ $collapseId }}" aria-expanded="false" aria-controls="{{ $collapseId }}">
                                                        {{ $category->name }}
                                                    </button>
                                                </h2>
                                                <div id="{{ $collapseId }}" class="accordion-collapse collapse" aria-labelledby="{{ $headingId }}" data-bs-parent="#prestationAccordion">
                                                    <div class="accordion-body">
                                                        <div id="prestation-buttons-{{ $category->id }}" class="prestation-buttons-container">
                                                            @foreach($category->prestations as $prestation)
                                                                <input type="checkbox" class="btn-check" id="prestation-{{ $prestation->id }}" data-id="{{ $prestation->id }}" data-duration="{{ $prestation->temps }}" autocomplete="off">
                                                                <label class="btn btn-outline-secondary prestation-btn" for="prestation-{{ $prestation->id }}">{{ $prestation->nom }} ({{ $prestation->temps }} min)</label>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    </body>
    </html>
@endsection
