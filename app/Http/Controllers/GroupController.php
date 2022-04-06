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

    public function set($data)
    {
        return '10) создать класс, 11) обновить класс (название)'.$data;
    }

    public function del($data)
    {
        return '12) удалить класс (при удалении класса, привязанные студенты должны открепляться от класса, но не удаляться полностью из системы)'.$data;
    }

    //  7) получить информацию о конкретном классе (название + студенты класса)
    public function info($data)
    {
        return Group::where('id', $data)->with('students')->get();
    }
}
