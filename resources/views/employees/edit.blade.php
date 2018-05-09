@extends('layouts.master')

@section('title')
    Edit  {{$employee->identification}}
@endsection

@push('head')
    <link href='/css/employees/form.css' type='text/css' rel='stylesheet'>
@endpush

@section('content')

    <h1>Edit</h1>
    <h2>{{ $employee->identification }}</h2>

    <form method='POST' action='/employees/{{ $employee->id }}'>
        {{ method_field('put') }}
        {{ csrf_field() }}

		@include('employees.employeeFormInputs')

        <input type='submit' value='Save changes' class='btn btn-primary'>
    </form>

    @include('modules.error-form')



@endsection