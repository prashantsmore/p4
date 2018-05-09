<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StaffRequest extends Model
{


  
    /*
    * Dump the essential details of books to the page
    * Used when practicing queries and you want to quickly see the books in the database
    * Can accept a Collection of books, or if none is provided, will default to all books
    */
    public static function dump($request = null)
    {
        # Empty array that will hold all our Employee data
        $data = [];

        # Determine if we should use $books as was passed to this method
        # or query for all books
        if (is_null($requests)) {
            # Query for all the books
            $staffRequests = self::all();
        }

        # Load the data array with the Employee info we want
        foreach ($staffRequests as $staffRequest) {
            $data[] = $staffRequest->request_id . ' has skill as ' . $staffRequest->skill;
        }
		
        dump($data);
		
    }
}
