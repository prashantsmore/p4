@extends('layouts.master')

@section('title')
    New Employee
@endsection

@push('head')
    <link href='/css/employees/form.css' type='text/css' rel='stylesheet'>
@endpush


@section('content')

    <h1>Add a new employee</h1>

    <form method='POST' action='/employees'>
        {{ csrf_field() }}

        @include('employees.employeeFormInputs')

        <input type='submit' value='Add Employee' class='btn btn-primary'>
    </form>

    @include('modules.error-form')

@endsection