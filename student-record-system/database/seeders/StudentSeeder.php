<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Student;

class StudentSeeder extends Seeder
{
    public function run(): void
    {
        Student::create(['student_id' => 'IT-2026-01', 'name' => 'Alice Santos', 'gpa' => 1.25]);
        Student::create(['student_id' => 'IT-2026-02', 'name' => 'Mark Reyes', 'gpa' => 1.75]);
        Student::create(['student_id' => 'IT-2026-03', 'name' => 'Chloe Cruz', 'gpa' => 2.00]);
    }
}