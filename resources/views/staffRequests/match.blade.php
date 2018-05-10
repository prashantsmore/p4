@extends('layouts.master')

@push('head')
    <link href='/css/employees/index.css' rel='stylesheet'>
@endpush

@section('title')
    Matching Employee List
@endsection

@section('content')


    <h3>Matching Employee(s) For Staffing Request Number {{ $staffId }} </h3>
    <p>
    <p>
    @if(count($matchEmployees) > 0)
        <div class="container">
            <table class="table-style-three">
                <thead>
                <tr>
                    <th>EMPLOYEE ID</th>
                    <th>NAME</th>
                    <th>ADDRESS</th>
                    <th>ASSIGN EMPLOYEE</th>
                </tr>
                </thead>
                <tbody>
                @foreach($matchEmployees as $matchEmployee)
                    <tr>
                        <td>{{ $matchEmployee->identification }}</td>
                        <td>{{ $matchEmployee->first_name }} , {{ $matchEmployee->last_name }} </td>
                        <td>{{ $matchEmployee->address_line_1}} , {{ $matchEmployee->address_line_2}}</td>
                        <td>
                            <a href='/staffRequests/{{ $matchEmployee->id }}/{{ $staffId }}/assignEmployee'><i class="fas fa fa-user"></i> Assign To The Request</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>



    @endif



@endsection