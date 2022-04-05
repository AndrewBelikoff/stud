<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LectureController extends Controller
{
    public function getAll(){
        return '13) получить список всех лекций';
    }

    public function set($data){
        return '15) создать лекцию, 16) обновить лекцию (тема, описание)'.$data;
    }

    public function del($data){
        return '17) удалить лекцию'.$data;
    }

    public function info($data){
        return '2) получить информацию о конкретном студенте (имя, email + класс + прослушанные лекции)'.$data;
    }
}
