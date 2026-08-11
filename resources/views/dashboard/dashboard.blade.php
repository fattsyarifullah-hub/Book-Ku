<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-red-900 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
@extends('layouts.dashboard')
@section('title', 'Dashboard')
@section('page-title', 'Dashboard Overview')

@section('content')
<h1>hai</h1>
@endsection