<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function getAll(){
        return '1) получить список всех студентов';
    }

    public function set($data){
        return '3) создать студента, 4) обновить студента (имя, принадлежность к классу)'.$data;
    }

    public function del($data){
        return '5) удалить студента'.$data;
    }

    public function info($data){
        return '2) получить информацию о конкретном студенте (имя, email + класс + прослушанные лекции)'.$data;
    }
}
