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
        <style>
            .calendar-container {
                display: flex;
                flex-direction: column;
                justify-content: flex-start;
                width: 100%;
            }
            .card {
                margin-bottom: 10px;
            }
            .collapse {
                visibility: visible;
            }
            .calendar {
                margin-bottom: 20px;
            }
            .accordion-button {
                background-color: transparent !important;
            }
        </style>
    </head>
    <body>
    <div class="content py-6 mt-10 pt-10">
        <section class="mt-10">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-3">
                        <div class="calendar-container">
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
                                        <li>Dim</li>
                                        <li>Lun</li>
                                        <li>Mar</li>
                                        <li>Mer</li>
                                        <li>Jeu</li>
                                        <li>Ven</li>
                                        <li>Sam</li>
                                    </ul>
                                    <ul class="days"></ul>
                                </div>
                                <div id="available-slots" class="mt-3">
                                    <h3>Créneaux Disponibles</h3>
                                    <div id="slots-container"></div>
                                </div>
                            </div>

                            <div class="prestation-select mt-3">
                                <h3>Sélectionner des Prestations:</h3>
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

                            <div class="user-select mt-3">
                                <h3>Sélectionner un Utilisateur:</h3>
                                <div class="d-flex align-items-center">
                                    <select class="user-select-dropdown form-control" name="user" id="user-select">
                                        <option value="" disabled selected>Sélectionner un utilisateur</option>
                                        @foreach($users as $user)
                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endforeach
                                        @foreach($temporaryUsers as $temporaryUser)
                                            <option value="temporary-{{ $temporaryUser->id }}">{{ $temporaryUser->name }}</option>
                                        @endforeach
                                    </select>
                                    <button id="add-user-btn" class="btn btn-primary ml-3" type="button">Ajouter Utilisateur</button>
                                </div>
                            </div>

                            <!-- Modal pour créer un nouvel utilisateur -->
                            <div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="addUserModalLabel">Ajouter un Nouvel Utilisateur</h5>
                                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Fermer">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form id="add-user-form">
                                                <div class="form-group">
                                                    <label for="user-name">Nom</label>
                                                    <input type="text" class="form-control" id="user-name" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="user-email">Email</label>
                                                    <input type="email" class="form-control" id="user-email" required>
                                                </div>
                                                <button type="submit" class="btn btn-primary">Ajouter Utilisateur</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> <!-- Fin de la première colonne -->
                    </div>

                    <div class="col-md-9">
                        <div class="appointments-table mt-3">
                            <h3>Tableau des Rendez-vous</h3>
                            <div class="employee-select mt-3">
                                <h3>Sélectionner des Employés:</h3>
                                <div id="employee-buttons" class="btn-group" role="group">
                                    @foreach(App\Models\Employee::all() as $employee)
                                        <input type="checkbox" class="btn-check" id="employee-{{ $employee->id }}" data-id="{{ $employee->id }}" autocomplete="off" checked>
                                        <label class="btn btn-outline-secondary" for="employee-{{ $employee->id }}">{{ $employee->name }}</label>
                                    @endforeach
                                </div>
                            </div>
                            <div id="appointments-table-container" class="table-responsive"></div>
                        </div>
                    </div> <!-- Fin de la deuxième colonne -->
                </div>
            </div>
        </section>
    </div>
    </body>
    </html>
@endsection
