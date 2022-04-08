<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use App\Models\Student;
use App\Models\Study;
use Illuminate\Http\Request;

class PlanController extends Controller
{
    //  8) получить учебный план (список лекций) для конкретного класса
    public function getPlan($id)
    {
        return Plan::where('group_id', $id)->get();
    }

    //  9) создать/обновить учебный план (очередность и состав лекций) для конкретного класса
    public function set(Request $request)
    {
        Plan::updateOrCreate(
            [
                'group_id' => $request->group_id,
                'lecture_id' => $request->lecture_id,
            ],
            [
                'order' => $request->order
            ]);

        foreach (Student::where('group_id', $request->group_id)->get() as $student) {
            Study::updateOrCreate(
                [
                    'student_id' => $student['id'],
                    'lecture_id' => $request->lecture_id,
                ],
                [
//                    'is_completed' => 0,
                ]
            );
        }

    }
}
