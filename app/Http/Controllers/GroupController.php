<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GroupController extends Controller
{
    public function getAll(){
        return '6) получить список всех классов';
    }

    public function set($data){
        return '10) создать класс, 11) обновить класс (название)'.$data;
    }

    public function del($data){
        return '12) удалить класс (при удалении класса, привязанные студенты должны открепляться от класса, но не удаляться полностью из системы)'.$data;
    }

    public function info($data){
        return '7) получить информацию о конкретном классе (название + студенты класса): '.$data;
    }
}
