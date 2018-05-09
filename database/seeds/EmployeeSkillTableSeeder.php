<?php

use Illuminate\Database\Seeder;
use App\Employee;
use App\Skill;


class EmployeeSkillTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        # First, create an array of all the books we want to associate tags with
        # The *key* will be the book title, and the *value* will be an array of tags.
        # Note: purposefully omitting the Harry Potter books to demonstrate untagged books
        $employees = [
            'E1' => ['Java', 'Oracle'],
            'E2' => ['Php', 'MySQL'],
            'E3' => ['Java', 'Php']
        ];

        # Now loop through the above array, creating a new pivot for each book to tag
        foreach ($employees as $identification => $skills) {

            # First get the book
            $employee = Employee::where('identification', 'like', $identification)->first();

            # Now loop through each tag for this book, adding the pivot
            foreach ($skills as $skillName) {
                $skill = Skill::where('name', 'LIKE', $skillName)->first();

                # Connect this tag to this book
                $employee->skills()->save($skill);
            }
        }

    }
}
