<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    /*
     public function staffingRequest()
        {
            # Employee belongs to Sta
            # Define an inverse one-to-many relationship.
            return $this->belongsTo('App\Author');
        }
    */

    public function skills()
    {
        # With timestamps() will ensure the pivot table has its created_at/updated_at fields automatically maintained
        return $this->belongsToMany('App\Skill')->withTimestamps();
    }

    /*
    * Dump the essential details of books to the page
    * Used when practicing queries and you want to quickly see the books in the database
    * Can accept a Collection of books, or if none is provided, will default to all books
    */
    public static function dump($employee = null)
    {
        # Empty array that will hold all our Employee data
        $data = [];

        # Determine if we should use $books as was passed to this method
        # or query for all books
        if (is_null($employees)) {
            # Query for all the books
            $employees = self::all();
        }

        # Load the data array with the Employee info we want
        foreach ($employees as $employee) {
            $data[] = $employee->first_name . ' has start_date as ' . $employee->start_date;
        }

        dump($data);
    }
}
