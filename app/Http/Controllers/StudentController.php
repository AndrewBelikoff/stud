<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use App\Models\Student;
use App\Models\Study;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    //  1) получить список всех студентов
    public function getAll()
    {
        return Student::all();
    }

    //  3) создать студента, 4) обновить студента (имя, принадлежность к классу)
    public function set(Request $request)
    {
        Student::updateOrCreate(
            [
                'email' => $request->email,
            ],
            [
                'name' => $request->name,
                'group_id' => $request->group_id,
            ]);

        $group_id = Student::where('email', $request->email)->pluck('group_id');
        $student_id = Student::where('email', $request->email)->value('id');

        $a = Study::where('student_id', $student_id)
            ->where('is_completed', 0)
            ->whereDoesntHave('plans', function ($q) use ($group_id) {
                $q->where('group_id', $group_id);
            })
            ->pluck('id');

        Study::destroy($a);


        foreach (Plan::where('group_id', $group_id)->get('lecture_id') as $lecture) {
            Study::updateOrCreate(
                [
                    'student_id' => $student_id,
                    'lecture_id' => $lecture->lecture_id,
                ],
                [
//                    'is_completed' => 0,
                ]
            );
        }

        return 'bl';
    }

    //  5) удалить студента
    public function del($id)
    {
        return Student::findOrFail($id)->delete();
    }

    //  2) получить информацию о конкретном студенте (имя, email + класс + прослушанные лекции)
    public function info($id)
    {
        return Student::where('id', $id)->with('lectures', function ($q) use ($id) {
            $q->where('is_completed', 1);
        })->get();
    }
}
