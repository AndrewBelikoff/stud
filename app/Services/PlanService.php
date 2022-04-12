<?php

namespace App\Services;

use App\Models\Plan;
use App\Models\Student;
use App\Models\Study;
use Illuminate\Support\Collection;

class PlanService
{
    public function getPlan($id): Collection
    {
        return Plan::where('group_id', $id)->get();
    }

    public function setPlan(array $data): Plan
    {
        $plan = Plan::updateOrCreate(
            [
                'group_id' => $data['group_id'],
                'lecture_id' => $data['lecture_id'],
            ],
            [
                'order' => $data['order']
            ]
        );

        foreach (Student::where('group_id', $data['group_id'])->get() as $student) {
            Study::updateOrCreate(
                [
                    'student_id' => $student['id'],
                    'lecture_id' => $data['lecture_id'],
                ],
                [
//                    'is_completed' => 0,
                ]
            );
        }
        return $plan;
    }

    public function newPlan(array $data): Collection
    {
        // удалить лекции старых планов
        $a = Study::where('is_completed', 0)
            ->whereHas('students', function ($q) use ($data) {
                $q->where('group_id', $data['group_id']);
            })
            ->pluck('id');
        Study::destroy($a);

        // удалить старые планы из планов
        Plan::where('group_id', $data['group_id'])->delete();

        // по каждой новой лекции создать запись
        foreach ($data['lectures'] as $order => $lecture) {
            Plan::create(
                [
                    'group_id' => $data['group_id'],
                    'lecture_id' => $lecture,
                    'order' => $order
                ]
            );

            // добавить каждому студенту лекции в соответствии с планом
            foreach (Student::where('group_id', $data['group_id'])->get() as $student) {
                Study::create(
                    [
                        'student_id' => $student['id'],
                        'lecture_id' => $lecture,
                        'is_completed' => 0,
                    ]
                );
            }
        }

        return Plan::where('group_id', $data['group_id'])->get();
    }
}
