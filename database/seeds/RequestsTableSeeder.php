<?php

use Illuminate\Database\Seeder;
use App\Request;

class RequestsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
              $staffRequests = [
            ['S1','Java','','',''],
			['S2','Php','','',''],
			['S3','MySQL','','',''],
			['S4','Java','','',''],
			['S5','Java','','',''],
		
        ];
		
		$count = count($staffRequests);
		
		  foreach ($staffRequests as $key => $requestData) {


            $staffRequest = new StaffRequest();
            $staffRequest->created_at = Carbon\Carbon::now()->subDays($count)->toDateTimeString();
            $staffRequest->updated_at = Carbon\Carbon::now()->subDays($count)->toDateTimeString();
            
			$staffRequest->request_id = $employeeData[0];
			$staffRequest->skill = $employeeData[1];

			$staffRequest->start_date = Carbon\Carbon::now()->subDays($count)->toDateTimeString();
			$staffRequest->end_date = Carbon\Carbon::now()->subDays($count)->toDateTimeString();
		
            $staffRequest->save();
            $count--;
        }
    }
}
