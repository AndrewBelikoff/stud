<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use App\Models\Study;
use Illuminate\Http\Request;

class PlanController extends Controller
{
    //  8) получить учебный план (список лекций) для конкретного класса
    public function getPlan()
    {
        return Plan::all();
    }

    //  9) создать/обновить учебный план (очередность и состав лекций) для конкретного класса
    public function set(Request $request)
    {
         Plan::updateOrCreate(
        [
            'id' => $request->id
        ],
        [
            'group_id' => $request->group_id,
            'lecture_id' => $request->lecture_id
        ]);

//        $group_id = Student::where('email', $request->email)->pluck('group_id');
//        $student_id = Student::where('email', $request->email)->value('id');
//
//        foreach (Plan::where('group_id', $group_id)->get('lecture_id') as $lecture) {
//            Study::updateOrCreate(
//                [
//                    'student_id' => $student_id,
//                    'lecture_id' => $lecture->lecture_id,
//                ],
//                [
////                    'is_completed' => 0,
//                ]
//            );
//        }
//return'zz';
    }
}
