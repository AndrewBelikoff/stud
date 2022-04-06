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
    public function del(Request $request)
    {
        return Group::where('id', $request->id)->delete();
    }

    //  7) получить информацию о конкретном классе (название + студенты класса)
    public function info(Request $request)
    {
        return Group::where('id', $request->id)->with('students')->get();
    }
}
