@extends('layouts.master')

@push('head')
    <link href='/css/employees/index.css' rel='stylesheet'>
@endpush

@section('title')
    Mathcing Employee List
@endsection

@section('content')


    <h3>Matching Employee List for Staffing Request Number{{ $staffId }} </h3>
	<p>
	<p>
	@if(count($matchEmployees) > 0)
	<div class="container">
	<div class="table">
		<div class="table-header">
			<div class="header__item">Staff ID2</div>
			<div class="header__item">Name</div>
			<div class="header__item">Address</div>
			<div class="header__item">Edit</div>
			<div class="header__item">Delete</div>
		</div>
		<div class="table-content">	
		  @foreach($matchEmployees as $matchEmployee)
      		<div class="table-row">		
				<div class="table-data">{{ $matchEmployee->identification }} </div>
				<div class="table-data">{{ $matchEmployee->first_name }} , {{ $matchEmployee->last_name }}</div>
				<div class="table-data">{{ $matchEmployee->address_line_1}} , {{ $matchEmployee->address_line_2}}</div>
				<div class="table-data"><a href='/staffRequests/{{ $matchEmployee->id }}/{{ $staffId }}/assignEmployee'><i class="fas fa-pencil-alt"></i> Assign To The Request</a></div>
			</div>
		@endforeach
		</div>	
	</div>
</div>
    @endif
       
    

@endsection