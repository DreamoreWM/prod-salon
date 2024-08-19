@extends('layouts.app')

@section('content')

    <style>
        .content {
            background-color: {{ $backgroundColor }};
        }

        .card {
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 16px;
            margin-bottom: 16px;
        }

        .card h5 {
            margin-bottom: 8px;
        }

        .card p {
            margin-bottom: 4px;
        }

        .card .btn {
            margin-right: 8px;
        }
    </style>

    <div class="content   ">
        <section class="">
            <div class="mx-auto max-w-screen-xl px-4 lg:px-12 m-2">
                <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden p-3">
                    <h1 class="text-3xl mb-4">Rendez-vous à venir</h1>
                    @foreach($upcomingAppointments as $appointment)
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">{{ $appointment->employee->name }}</h5>
                                <p class="card-text">
                                    <strong>Date:</strong> {{ $appointment->formatted_start_time }}<br>
                                    <strong>Fin:</strong> {{ $appointment->formatted_end_time }}<br>
                                    <strong>Prix total :</strong> {{ $appointment->total_price }} €<br>
                                    <strong>Prestations:</strong>
                                <ul>
                                    @foreach($appointment->prestations as $prestation)
                                        <li>{{ $prestation->nom }} - {{ $prestation->prix }} €</li>
                                    @endforeach
                                </ul>
                                </p>
                                <form method="POST" action="{{ route('appointments.cancel', $appointment) }}" class="d-inline" id="cancel-form-{{ $appointment->id }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-danger" onclick="confirmCancel({{ $appointment->id }})">
                                        <i class="fas fa-times-circle"></i> Annuler
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach

                    <h1 class="text-3xl mt-6 mb-4">Rendez-vous passés</h1>
                    @foreach($pastAppointments as $appointment)
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">{{ $appointment->employee->name }}</h5>
                                <p class="card-text">
                                    <strong>Date:</strong> {{ $appointment->formatted_start_time }}<br>
                                    <strong>Fin:</strong> {{ $appointment->formatted_end_time }}<br>
                                    <strong>Prix total :</strong> {{ $appointment->total_price }} €<br>
                                    <strong>Prestations:</strong>
                                <ul>
                                    @foreach($appointment->prestations as $prestation)
                                        <li>{{ $prestation->nom }} - {{ $prestation->prix }} €</li>
                                    @endforeach
                                </ul>
                                </p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    </div>


    <script>
        function confirmCancel(appointmentId) {
            Swal.fire({
                title: 'Êtes-vous sûr?',
                text: "Vous ne pourrez pas annuler cette action!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Oui, annulez-le!',
                cancelButtonText: 'Non, garder'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('cancel-form-' + appointmentId).submit();
                }
            })
        }
    </script>
@endsection
