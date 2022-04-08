<?php

namespace App\Services;

use App\Models\Plan;
use App\Models\Student;
use App\Models\Study;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class StudentService
{
    public function getAll(): Collection
    {
        return Student::all();
    }

    public function set(Request $request): Collection
    {
        $request = $request; //TODO validate
        $student = Student::updateOrCreate(
            [
                'email' => $request->email,
            ],
            [
                'name' => $request->name,
                'group_id' => $request->group_id,
            ]
        );

//        $group_id = Student::where('email', $request->email)->pluck('group_id');
//        $student_id = Student::where('email', $request->email)->value('id');

        $a = Study::where('student_id', $student['id'])
            ->where('is_completed', 0)
            ->whereDoesntHave('plans', function ($q) use ($student) {
                $q->where('group_id', $student['group_id']);
            })
            ->pluck('id');
        Study::destroy($a);

        foreach (Plan::where('group_id', $student['group_id'])->get('lecture_id') as $lecture) {
            Study::updateOrCreate(
                [
                    'student_id' => $student['id'],
                    'lecture_id' => $lecture->lecture_id,
                ],
                [
//                    'is_completed' => 0,
                ]
            );
        }
        return $student;
    }

    public function info($id): Collection
    {
        return Student::where('id', $id)->with('lectures', function ($q) use ($id) {
            $q->where('is_completed', 1);
        })->get();
    }

    public function del($id): bool
    {
        return Student::findOrFail($id)->delete();
    }
}
