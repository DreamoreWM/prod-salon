@extends('layouts.app')

@section('content')

<style>
    .content {
        background-color: {{ $backgroundColor }};
        min-height: 100vh;
    }
</style>

    <div class="content py-6">
        <div class="container mt-5">
            <section class="mt-10">
                <div class="mx-auto max-w-screen-xl px-4 lg:px-12 m-2">
                    <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden p-3">
                        <h1 class="text-3xl mb-4">Ajouter une absence</h1>
                        <form method="POST" action="{{ route('absences.store') }}">
                            @csrf
                            <div class="mb-3">
                                <label for="employee_id" class="form-label"><i class="fas fa-user"></i> Employé :</label>
                                <select id="employee_id" name="employee_id" class="form-control" required>
                                    @foreach($employees as $employee)
                                        <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="start_time" class="form-label"><i class="fas fa-calendar-alt"></i> Date de début :</label>
                                <input type="datetime-local" id="start_time" name="start_time" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="end_time" class="form-label"><i class="fas fa-calendar-alt"></i> Date de fin :</label>
                                <input type="datetime-local" id="end_time" name="end_time" class="form-control" required>
                            </div>
                            <button type="submit" class="btn btn-primary"><i class="fas fa-plus-circle"></i> Ajouter</button>
                        </form>
                    </div>
                </div>
            </section>
        </div>
    </div>

@endsection
