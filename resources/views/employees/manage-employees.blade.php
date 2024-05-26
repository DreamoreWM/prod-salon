@extends('layouts.app')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Gestion des Coiffeurs') }}
    </h2>
@endsection


@section('content')

    <style>
        .content {
            background-color: #ff9a18;
        }

    </style>
    <div class="content py-6">
        <livewire:employees-slots-table/>
    </div>
@endsection
