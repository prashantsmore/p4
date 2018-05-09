<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(SkillsTableSeeder::class);
        $this->call(EmployeesTableSeeder::class);
		$this->call(EmployeeSkillTableSeeder::class);
		$this->call(StaffRequestsTableSeeder::class);

    }
}
