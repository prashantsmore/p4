<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Log;
use App\Employee;
use App\Skill;
use App\StaffRequest;
use Carbon;

class EmployeeController extends Controller
{
    /*
     * GET /employees
     */
    public function index()
    {
        $employees = Employee::orderBy('identification')->get();

        # Query the database to get the last 3 books added
        # $newBooks = Book::latest()->limit(3)->get();

        # [Better] Query the existing Collection to get the last 3 books added
        $newEmployees = $employees->sortByDesc('created_at')->take(3);

        return view('employees.index')->with([
            'employees' => $employees,
            'newEmployees' => $newEmployees,
        ]);
    }

    /*
     * GET /books/{id}
     */
    public function show($id)
    {
        $employee = Employee::find($id);

        if (!$employee) {
            return redirect('/employees')->with(
                ['alert' => 'employee ' . $id . ' not found.']
            );
        }

        return view('employees.show')->with([
            'employee' => $employee
        ]);
    }

    /**
     * GET /books/search
     * @Todo: Refactor to search the books in the database, not books.json
     * @Todo: Outsource some of the logic to a separate class
     */
    public function search(Request $request)
    {
        # Start with an empty array of search results; books that
        # match our search query will get added to this array
        $searchResults = [];

        # Store the searchTerm in a variable for easy access
        # The second parameter (null) is what the variable
        # will be set to *if* searchTerm is not in the request.
        $searchTerm = $request->input('searchTerm', null);

        # Only try and search *if* there's a searchTerm
        if ($searchTerm) {
            # Open the books.json data file
            # database_path() is a Laravel helper to get the path to the database folder
            # See https://laravel.com/docs/helpers for other path related helpers
            $booksRawData = file_get_contents(database_path('/books.json'));

            # Decode the book JSON data into an array
            # Nothing fancy here; just a built in PHP method
            $books = json_decode($booksRawData, true);

            # Loop through all the book data, looking for matches
            # This code was taken from v0 of foobooks we built earlier in the semester
            foreach ($books as $title => $book) {
                # Case sensitive boolean check for a match
                if ($request->has('caseSensitive')) {
                    $match = $title == $searchTerm;
                    # Case insensitive boolean check for a match
                } else {
                    $match = strtolower($title) == strtolower($searchTerm);
                }

                # If it was a match, add it to our results
                if ($match) {
                    $searchResults[$title] = $book;
                }
            }
        }

        # Return the view, with the searchTerm *and* searchResults (if any)
        return view('books.search')->with([
            'searchTerm' => $searchTerm,
            'caseSensitive' => $request->has('caseSensitive'),
            'searchResults' => $searchResults
        ]);
    }

    /**
     * Show the form to create a new Employee
     * GET /employees/create
     */
    public function create(Request $request)
    {
        return view('employees.create')->with([
            //'authorsForDropdown' => Author::getForDropdown(),
            'skillsForCheckboxes' => Skill::getForCheckboxes(),
            'employee' => new Employee(),
            'skills' => [],
        ]);
    }

    /**
     * Process the form to create a new employee
     * POST /employees
     */
    public function store(Request $request)
    {
        # Custom validation messages
        $messages = [
            'author_id.required' => 'The author field is required.',
        ];

        $this->validate($request, [
            'identification' => 'required',
			'first_name' => 'required',
			'last_name' => 'required',
			'address_line_1' => 'required',
            'city' => 'required',
			'state' => 'required',
			'zip_code' => 'required',
			'telephone_number' => 'required',
			'age' => 'required|digits:2|numeric',
			'sex' => 'required',
        ], $messages);

        # Save the book to the database
        
		 $employee = new Employee();
            //$employee->created_at = Carbon\Carbon::now()->subDays($count)->toDateTimeString();
            //$employee->updated_at = Carbon\Carbon::now()->subDays($count)->toDateTimeString();
            
			$employee->identification = $request->identification;
			$employee->first_name = $request->first_name;
            $employee->last_name = $request->last_name;
            $employee->address_line_1 = $request->address_line_1;
            $employee->address_line_2 = $request->address_line_2;
            $employee->city = $request->city;
            $employee->state = $request->state;
            $employee->zip_code = $request->zip_code;
            $employee->telephone_number = $request->telephone_number;
            $employee->age = $request->age;
			$employee->sex = $request->sex;
			$employee->start_date = Carbon\Carbon::now()->toDateTimeString(); 
			$employee->end_date = Carbon\Carbon::now()->toDateTimeString();;
		
            $employee->save();
		
		
		    $employee->skills()->sync($request->input('skills'));

        # Logging code just as proof of concept that this method is being invoked
        # Log::info('Add the book ' . $book->title);

        # Send the user back to the page to add a book; include the title as part of the redirect
        # so we can display a confirmation message on that page
        return redirect('/employees/create')->with([
            'alert' => 'New Employee ' . $employee->first_name . ' was added.'
        ]);
    }

    /**
     * Show the form to edit an existing book
     * GET /books/{id}/edit
     */
    public function edit($id)
    {
        # Get this book and eager load its tags
        $employee = Employee::with('skills')->find($id);

        # Handle the case where we can't find the given book
        if (!$employee) {
            return redirect('/employees')->with(
                ['alert' => 'Employee ' . $id . ' not found.']
            );
        }

        # Show the employee edit form
        return view('employees.edit')->with([
            'skillsForCheckboxes' => Skill::getForCheckboxes(),
            'skills' => $employee->skills()->pluck('skills.id')->toArray(),
            'employee' => $employee
        ]);
    }

    /**
     * Process the form to edit an existing book
     * PUT /books/{id}
     */
    public function update(Request $request, $id)
    {
        # Custom validation messages
        $messages = [
            'author_id.required' => 'The author field is required.',
        ];

        $this->validate($request, [
            'identification' => 'required',
			'first_name' => 'required',
			'last_name' => 'required',
			'address_line_1' => 'required',
            'city' => 'required',
			'state' => 'required',
			'zip_code' => 'required',
			'telephone_number' => 'required',
			'age' => 'required|digits:2|numeric',
			'sex' => 'required',
        ], $messages);

        # Fetch the book we want to update
        $employee = Employee::find($id);

        # Update data
			$employee->identification = $request->identification;
			$employee->first_name = $request->first_name;
            $employee->last_name = $request->last_name;
            $employee->address_line_1 = $request->address_line_1;
            $employee->address_line_2 = $request->address_line_2;
            $employee->city = $request->city;
            $employee->state = $request->state;
            $employee->zip_code = $request->zip_code;
            $employee->telephone_number = $request->telephone_number;
            $employee->age = $request->age;
			$employee->sex = $request->sex;
			$employee->start_date = Carbon\Carbon::now()->toDateTimeString(); 
			$employee->end_date = Carbon\Carbon::now()->toDateTimeString();;


		    $employee->skills()->sync($request->input('skills'));
		
            $employee->save();
		
		

        # Send the user back to the edit page in case they want to make more edits
        return redirect('/employees/' . $id . '/edit')->with([
            'alert' => 'Your changes were saved'
        ]);
    }

    /*
    * Asks user to confirm they actually want to delete the book
    * GET /books/{id}/delete
    */
    public function delete($id)
    {
        $employee = Employee::find($id);

        if (!$employee) {
            return redirect('/employees')->with('alert', 'Employee not found');
        }

        return view('employees.delete')->with([
            'employee' => $employee,
        ]);
    }

    /*
    * Actually deletes the book
    * DELETE /books/{id}/delete
    */
    public function destroy($id)
    {
        $employee = Employee::find($id);

        # Before we delete the book we have to delete any tag associations
        $employee->skills()->detach();

        $employee->delete();

        return redirect('/employees')->with([
            'alert' => '“' . $employee->identification . '” was removed.'
        ]);
    }
	
	/*
    * displays list of Open Requests
    * 
    */
    public function showRequests()
    {
       $staffRequests = StaffRequest::whereNull ('employee_id')
	   ->orderBy('request_id')->get();
		   
	   return view('staffRequests.index')->with([
            'staffRequests' => $staffRequests,
        ]);

      
    }

    public function matchEmp($id)
    {
       
	  $matchEmployees = Employee::join('employee_skill' , 'employees.id', '=' ,'employee_skill.employee_id')
	                           ->join('skills','employee_skill.skill_id', '=','skills.id')
							   ->join('staff_requests','skills.name', '=','staff_requests.skill_required')
							   ->setBindings([$id])
                               ->where('staff_requests.id', '=','?')->get();
	  
	  
	 
        return view('staffRequests.match')->with([
            'matchEmployees' => $matchEmployees,
			'staffId' => $id,
        ]);
	    
    }
	
	public function assignEmployee($employeeId,$staffId)
    {
		
	  $staffRequest = StaffRequest::find($staffId);
	  $staffRequest->employee_id = $employeeId;
	  $staffRequest->save();
	  
	  $employee = Employee::find($employeeId);

        # Send the user back to the page to add a book; include the title as part of the redirect
        # so we can display a confirmation message on that page
        return redirect('/requests')->with([
			'alert' => 'Employee ' . $employee->first_name . ' was assigned to Staff Request ' . $staffId 
        ]);
        
    }
}