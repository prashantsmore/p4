@extends('layouts.master')

@push('head')
    <link href='/css/employees/index.css' rel='stylesheet'>
@endpush

@section('title')
    UnFulfilled Staffing Request
@endsection

@section('content')

   
    <h2>UnFulfilled Staffing Request</h2>
	@if(count($staffRequests) > 0)
	<div class="container">
	<div class="table">
		<div class="table-header">
			<div class="header__item">Request ID</div>
			<div class="header__item">Skill</div>
			<div class="header__item">Start Date</div>
			<div class="header__item">End Date</div>
			<div class="header__item">Assign Employee</div>
		</div>
		<div class="table-content">		
		  @foreach($staffRequests as $staffRequest)
      		<div class="table-row">		
				<div class="table-data">{{ $staffRequest->request_id }} </div>
				<div class="table-data">{{ $staffRequest->skill_required }}</div>
				<div class="table-data">{{ $staffRequest->start_date}} </div>
				<div class="table-data">{{ $staffRequest->end_date}} </div>
				<div class="table-data"><a href='/staffRequests/{{ $staffRequest->id }}/match'><i class="fas fa-pencil-alt"></i> Find Matching Employee</a></div>
				<div class="table-data"><a href='/staffRequests/{{ $staffRequest->id }}/delete'><i class="fas fa-trash-alt"></i> Delete</a></div>
			</div>
		@endforeach
		</div>	
	</div>
</div>
    @endif
       
    

@endsection