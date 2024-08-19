@extends('layouts.app')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Gestion des Coiffeurs') }}
    </h2>
@endsection


@section('content')

    <style>
        .content {
            background-color: {{ $background_color }};
        }

    </style>
    <div class="content   ">
        <livewire:employees-slots-table/>
    </div>
@endsection
