<?php

use Illuminate\Database\Seeder;
use App\Skill;

class SkillsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $skills = ['Java','Oracle','Php','MySQL'];

        foreach ($skills as $skillName) {
            $skill = new Skill();
            $skill->name = $skillName;
            $skill->save();
        }
    }
}
