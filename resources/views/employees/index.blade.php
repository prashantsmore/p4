@extends('layouts.master')

@push('head')
    <link href='/css/employees/index.css' rel='stylesheet'>
@endpush

@section('title')
    Active Employee List
@endsection

@section('content')

    @if(count($newEmployees) > 0)
        <aside id='newEmployees'>
            <h3>Employees Recently Joined Or Assigned </h3>
            @foreach($newEmployees as $employee)
                <p class="text-capitalize">
                    <small><a href='/employees/{{ $employee->id }}/edit'>
                            <bold>Employee ID  </bold>{{ $employee->identification }} </a> Updated On
                        <i> {{ $employee->updated_at->toDayDateTimeString() }} </i></small>
                </p>
            @endforeach
        </aside>
    @endif

    <h3>Complete Employee List</h2>
        @if(count($employees) > 0)
            <div class="container">
                <table class="table-style-three">
                    <thead>
                    <tr>
                        <th>EMPLOYEE ID</th>
                        <th>NAME</th>
                        <th>ADDRESS</th>
                        <th>EDIT</th>
                        <th>DELETE</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($employees as $employee)
                        <tr>
                            <td>{{ $employee->identification }}</td>
                            <td>{{ $employee->first_name }} , {{ $employee->last_name }}</td>
                            <td>{{ $employee->address_line_1}} , {{ $employee->address_line_2}}</td>
                            <td><a href='/employees/{{ $employee->id }}/edit'><i class="fas fa-pencil-alt"></i> Edit</a>
                            </td>
                            <td><a href='/employees/{{ $employee->id }}/delete'><i class="fas fa-trash-alt"></i> Delete</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

    @endif
@endsection