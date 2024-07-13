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
                    <div class="py-4 px-3">
                        <div class="flex ">
                            <div class="flex space-x-4 items-center mb-3">
                                <label class="w-32 text-sm font-medium text-gray-900">Per Page</label>
                                <form id="perPageForm" method="GET" action="{{ route('absences.index') }}">
                                    <select name="per_page" onchange="document.getElementById('perPageForm').submit()"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                        <option value="3" {{ $perPage == 3 ? 'selected' : '' }}>3</option>
                                        <option value="5" {{ $perPage == 5 ? 'selected' : '' }}>5</option>
                                        <option value="10" {{ $perPage == 10 ? 'selected' : '' }}>10</option>
                                        <option value="20" {{ $perPage == 20 ? 'selected' : '' }}>20</option>
                                        <option value="50" {{ $perPage == 50 ? 'selected' : '' }}>50</option>
                                        <option value="100" {{ $perPage == 100 ? 'selected' : '' }}>100</option>
                                    </select>
                                </form>
                            </div>
                        </div>
                        {{ $absences->links() }}
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
