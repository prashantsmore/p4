<?php

use Illuminate\Database\Seeder;
use App\Employee;

class EmployeesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $employees = [
            ['E1','John', 'Doe', '18 Kepler Road', '#2', 'Natick','MA','01902','5085670909',30,'Male','',''],
			['E2','Jane', 'Doe', '12 Foreest Road', '#1', 'Stoughton','MA','01902','7085670909',45,'Female','',''],
			['E3','Mike', 'Pal', '10 Wellesly Road', '#1', 'Stoughton','MA','01902','7085670909',50,'Male','',''],
        ];
		
		$count = count($employees);
		
		  foreach ($employees as $key => $employeeData) {


            $employee = new Employee();
            $employee->created_at = Carbon\Carbon::now()->subDays($count)->toDateTimeString();
            $employee->updated_at = Carbon\Carbon::now()->subDays($count)->toDateTimeString();
            
			$employee->identification = $employeeData[0];
			$employee->first_name = $employeeData[1];
            $employee->last_name = $employeeData[2];
            $employee->address_line_1 = $employeeData[3];
            $employee->address_line_2 = $employeeData[4];
            $employee->city = $employeeData[5];
            $employee->state = $employeeData[6];
            $employee->zip_code = $employeeData[7];
            $employee->telephone_number = $employeeData[8];
            $employee->age = $employeeData[9];
			$employee->sex = $employeeData[10];
			$employee->start_date = Carbon\Carbon::now()->subDays($count)->toDateTimeString();
			$employee->end_date = Carbon\Carbon::now()->subDays($count)->toDateTimeString();
		
            $employee->save();
            $count--;
        }
    }
}
