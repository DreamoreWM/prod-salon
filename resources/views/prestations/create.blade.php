{{-- Vue Blade pour prendre un rendez-vous --}}
@extends('layouts.app')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800  leading-tight">
        {{ __('Création de prestation') }}
    </h2>
@endsection

@section('content')


    <div class="content mt-10 pt-10">
        <div style="background-color: {{ $background_color }}; min-height: 100vh; padding: 20px">
            <livewire:prestations-management />
        </div>
    </div>

@endsection
