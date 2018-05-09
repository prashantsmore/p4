@extends('layouts.master')

@push('head')
    <link href='/css/employees/delete.css' rel='stylesheet'>
@endpush

@section('title')
    Confirm deletion: {{ $employee->identification }}
@endsection

@section('content')
    <h1>Confirm deletion</h1>

    <p>Are you sure you want to delete <strong>{{ $employee->identification }}</strong>?</p>

   
    <form method='POST' action='/employees/{{ $employee->id }}'>
        {{ method_field('delete') }}
        {{ csrf_field() }}
        <input type='submit' value='Yes' class='btn btn-danger btn-small'>
    </form>

    <p class='cancel'>
        <a href='/employees'>No</a>
    </p>

@endsection
