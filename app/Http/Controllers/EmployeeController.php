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

        $newEmployees = $employees->sortByDesc('created_at')->take(3);

        return view('employees.index')->with([
            'employees' => $employees,
            'newEmployees' => $newEmployees,
        ]);
    }

    /*
     * Display Specific Employee
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
     * Show the form to create a new Employee
     * GET /employees/create
     */
    public function create(Request $request)
    {
        return view('employees.create')->with([
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
            'first_name.required' => 'The first name field is required.',
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

        return redirect('/employees/create')->with([
            'alert' => 'New Employee ' . $employee->first_name . ' was added.'
        ]);
    }

    /**
     * Show the form to edit an existing employee
     * GET /employees/{id}/edit
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
     * Process the form to edit an existing employee
     * PUT /employees/{id}
     */
    public function update(Request $request, $id)
    {
        # Custom validation messages
        $messages = [
            'first_name.required' => 'The first_name field is required.',
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

        return redirect('/employees/' . $id . '/edit')->with([
            'alert' => 'Your changes were saved'
        ]);
    }

    /*
    * GET /employees/{id}/delete
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
    * DELETE /employees/{id}/delete
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
        $staffRequests = StaffRequest::whereNull('employee_id')
            ->orderBy('request_id')->get();

        return view('staffRequests.index')->with([
            'staffRequests' => $staffRequests,
        ]);
    }

    public function matchEmp($id)
    {
        $matchEmployees = Employee::join('employee_skill', 'employees.id', '=', 'employee_skill.employee_id')
            ->join('skills', 'employee_skill.skill_id', '=', 'skills.id')
            ->join('staff_requests', 'skills.name', '=', 'staff_requests.skill_required')
            ->setBindings([$id])
            ->where('staff_requests.id', '=', '?')->get();

        return view('staffRequests.match')->with([
            'matchEmployees' => $matchEmployees,
            'staffId' => $id,
        ]);
    }

    public function assignEmployee($employeeId, $staffId)
    {
        $staffRequest = StaffRequest::find($staffId);
        $staffRequest->employee_id = $employeeId;
        $staffRequest->save();

        $employee = Employee::find($employeeId);

        return redirect('/requests')->with([
            'alert' => 'Employee ' . $employee->first_name . ' was assigned to Staff Request ' . $staffId
        ]);
    }
}