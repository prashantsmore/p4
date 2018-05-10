@extends('layouts.master')

@push('head')
    <link href='/css/employees/index.css' rel='stylesheet'>
@endpush

@section('title')
    UnFulfilled Staffing Request
@endsection

@section('content')

    <h3>Unfulfilled Staffing Request</h3>
        @if(count($staffRequests) > 0)
            <div class="container">
                <table class="table-style-three">
                    <thead>
                    <tr>
                        <th>REQUEST ID</th>
                        <th>SKILL</th>
                        <th>START DATE</th>
                        <th>END DATE</th>
                        <th>ASSIGN EMPLOYEE</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($staffRequests as $staffRequest)
                        <tr>
                            <td>{{ $staffRequest->request_id  }}</td>
                            <td>{{ $staffRequest->skill_required }} </td>
                            <td>{{ $staffRequest->start_date }}</td>
                            <td>{{ $staffRequest->end_date}}</td>
                            <td>
                                <a href='/staffRequests/{{ $staffRequest->id }}/match'><i class="fas fa fa-search"></i> Find Matching Employee</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

    @endif



@endsection