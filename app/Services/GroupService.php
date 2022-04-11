<?php

namespace App\Services;

use App\Models\Group;
use App\Models\Plan;
use App\Models\Student;
use App\Models\Study;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class GroupService
{
    //  6) получить список всех классов
    public function getAll(): Collection
    {
        return Group::all();
    }

    //  10) создать класс, 11) обновить класс (название)
    public function set(array $data): Group
    {
        return Group::updateOrCreate(
            [
                'id' => $data['id']
            ],
            [
                'title' => $data['title']
            ]
        );
    }

    //  12) удалить класс (при удалении класса, привязанные студенты должны открепляться от класса, но не удаляться полностью из системы)
    public function del($id): bool
    {
        return Group::findOrFail($id)->delete();
    }

    //  8) получить учебный план (список лекций) для конкретного класса
    public function info($id): Collection
    {
        return Group::where('id', $id)->with('students')->get();
    }
}
