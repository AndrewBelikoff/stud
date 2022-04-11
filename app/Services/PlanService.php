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
}
