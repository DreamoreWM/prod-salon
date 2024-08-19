@extends('layouts.app')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Gestion des Utilisateurs') }}
    </h2>
@endsection

@section('content')
    <div class="">
        <livewire:users-slot-table/>
    </div>
@endsection
