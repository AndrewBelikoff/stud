<?php

namespace App\Http\Controllers;

use App\Models\Group;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    //  6) получить список всех классов
    public function getAll()
    {
        return Group::all();
    }


    //  10) создать класс, 11) обновить класс (название)
    public function set(Request $request)
    {

        return Group::updateOrCreate(
            [
                'id' => $request->id
            ],
            [
                'title' => $request->title
            ]);
    }

    //  12) удалить класс (при удалении класса, привязанные студенты должны открепляться от класса, но не удаляться полностью из системы)
    public function del($id)
    {
        return Group::findOrFail($id)->delete();
    }

    //  8) получить учебный план (список лекций) для конкретного класса
    public function info($id)
    {
        return Group::where('id', $id)->with('students')->get();
    }


}
