{{-- Vue Blade pour prendre un rendez-vous --}}
@extends('layouts.app')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800  leading-tight">
        {{ __('Création de prestation') }}
    </h2>
@endsection

@section('content')

    <style>
        .content {
            background-color: {{ $background_color }};
        }
    </style>

    <div class="content  ">
        <section>
                <livewire:prestations-management />
        </section>
    </div>

@endsection
