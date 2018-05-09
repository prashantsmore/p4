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
            <h2>Recently Joined</h2>
            <ul>
                @foreach($newEmployees as $employee)
                    <li><a href='/employees/{{ $employee->id }}'>{{ $employee->identification }}</a></li>
                @endforeach
            </ul>
        </aside>
    @endif

    <h2>Complete Employee List</h2>
	@if(count($employees) > 0)
	<div class="container">
	<div class="table">
		<div class="table-header">
			<div class="header__item">Staff ID</div>
			<div class="header__item">Name</div>
			<div class="header__item">Address</div>
			<div class="header__item">Edit</div>
			<div class="header__item">Delete</div>
		</div>
		<div class="table-content">	
		  @foreach($employees as $employee)
      		<div class="table-row">		
				<div class="table-data">{{ $employee->identification }} </div>
				<div class="table-data">{{ $employee->first_name }} , {{ $employee->last_name }}</div>
				<div class="table-data">{{ $employee->address_line_1}} , {{ $employee->address_line_2}}</div>
				<div class="table-data"><a href='/employees/{{ $employee->id }}/edit'><i class="fas fa-pencil-alt"></i> Edit</a></div>
				<div class="table-data"><a href='/employees/{{ $employee->id }}/delete'><i class="fas fa-trash-alt"></i> Delete</a></div>
			</div>
		@endforeach
		</div>	
	</div>
</div>
    @endif
       
    

@endsection