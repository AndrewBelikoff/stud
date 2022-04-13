<?php

namespace App\Services;

use App\Models\Plan;
use App\Models\Student;
use App\Models\Study;
use Exception;
use Illuminate\Database\Eloquent\Collection;

class StudentService
{
    public function getAll(): Collection
    {
        return Student::all();
    }

    public function set(array $data): Student
    {
        if (array_key_exists('id', $data) && $student = Student::find($data['id'])) {
            $student->fill($data)->save();
        } elseif (array_key_exists('email', $data)
            && array_key_exists('name', $data)
            && array_key_exists('group_id', $data)) {
            $student = Student::create(
                [
                    'email' => $data['email'],
                    'name' => $data['name'],
                    'group_id' => $data['group_id'],
                ]
            );
        } else {
            throw new Exception('not enough data');
        };

        // удалить старые лекции
        $a = Study::where('student_id', $student['id'])
            ->where('is_completed', 0)
            ->whereDoesntHave('plans', function ($q) use ($student) {
                $q->where('group_id', $student['group_id']);
            })
            ->pluck('id');
        Study::destroy($a);

        // записать новые лекции в соответствии с учебным планом
        foreach (Plan::where('group_id', $student['group_id'])->get('lecture_id') as $lecture) {
            Study::create(
                [
                    'student_id' => $student['id'],
                    'lecture_id' => $lecture->lecture_id,
                    'is_completed' => 0,
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
