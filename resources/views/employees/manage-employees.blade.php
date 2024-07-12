@extends('layouts.app')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Gestion des Coiffeurs') }}
    </h2>
@endsection


@section('content')

    <style>
        .content {
            min-height: 100vh;
            background-color: {{ $background_color }};
        }

    </style>
    <div class="content py-6 mt-10 pt-10">
        <livewire:employees-slots-table/>
    </div>
@endsection
