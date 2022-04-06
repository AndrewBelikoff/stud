<?php

namespace Database\Seeders;

use App\Models\Plan;
use App\Models\Student;
use App\Models\Study;
use Illuminate\Database\Seeder;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Student::factory(20)->create()
            ->each(function ($student) {
                foreach ($student->lectures->pluck('id') as $lecture) {
                    Study::updateOrCreate(
                        [
                        'student_id' => $student['id'],
                        'lecture_id' => $lecture,
                        ],
                        [
                        'is_completed' => 0
                    ]
                    );
                }
            });
    }
}
