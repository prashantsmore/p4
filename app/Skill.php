<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    /*
     * Define the many to many relationship with employees
     */
    public function employees()
    {
        # With timestamps() will ensure the pivot table has its created_at/updated_at fields automatically maintained
        return $this->belongsToMany('App\Employee')->withTimestamps();
    }

    /*
     * Generate an array of skills where key = skill id and value = skill name
     */
    public static function getForCheckboxes()
    {
        $skills = self::orderBy('name')->get();

        $skillsForCheckboxes = [];

        foreach ($skills as $skill) {
            $skillsForCheckboxes[$skill->id] = $skill->name;
        }

        return $skillsForCheckboxes;
    }
}
