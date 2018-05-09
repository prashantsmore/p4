@extends('layouts.master')

@section('title')
    {{ $employee->identification }}
@endsection

@push('head')
    <link href='/css/employees/show.css' type='text/css' rel='stylesheet'>
@endpush

@section('content')
    <h1>{{ $employee->identification }}</h1>

    <div class='book cf'>
        <h2>{{ $employee->identification }}</h2>
        <p>First Name {{ $employee->first_name }}</p>
        <p>Last Name {{ $employee->last_name }}</p>

        <ul class='bookActions'>
            <li><a href='/employees/{{ $employee->id }}/edit'><i class="fas fa-pencil-alt"></i> Edit</a>
            <li><a href='/employees/{{ $employee->id }}/delete'><i class="fas fa-trash-alt"></i> Delete</a>
        </ul>
    </div>
@endsection

