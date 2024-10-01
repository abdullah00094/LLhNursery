<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Grade;
use App\Models\Absence;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

           // Create grades
           $grades = Grade::factory()->count(3)->create();
   
   
           // Create students with grades and generate absences
           Student::factory()
               ->count(15)
               ->has(Absence::factory()->count(2)) // Each student has 3 absences
               ->create();
       }
    }

