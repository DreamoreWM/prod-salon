@extends('layouts.app')

@section('content')

    <style>
        .content {
            background-color: {{ $backgroundColor }};
            min-height: 100vh;
        }
    </style>
    <div class="content py-6 mt-10 pt-10">
        <section class="mt-10">
            <div class="mx-auto max-w-screen-xl px-4 lg:px-12 m-2">
                <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden p-3">
                    <h1 class="text-3xl mb-4">Liste des absences</h1>
                    <a href="{{ route('absences.create') }}" class="btn btn-primary mb-4">
                        <i class="fas fa-plus-circle"></i> Ajouter une absence
                    </a>
                    @foreach($absences as $absence)
                        <div class="card mb-4 shadow-sm">
                            <div class="card-body">
                                <h5 class="card-title">{{ $absence->employee->name }}</h5>
                                <p class="card-text">
                                    <strong>Début:</strong> {{ \Carbon\Carbon::parse($absence->start_time)->translatedFormat('d F Y à H:i') }}<br>
                                    <strong>Fin:</strong> {{ \Carbon\Carbon::parse($absence->end_time)->translatedFormat('d F Y à H:i') }}
                                </p>
                                <a href="{{ route('absences.edit', $absence) }}" class="btn btn-warning">
                                    <i class="fas fa-edit"></i> Modifier
                                </a>
                                <form method="POST" action="{{ route('absences.destroy', $absence) }}" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">
                                        <i class="fas fa-trash-alt"></i> Supprimer
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                    <!-- Liens de pagination -->
                </div>
            </div>
        </section>
    </div>
@endsection
