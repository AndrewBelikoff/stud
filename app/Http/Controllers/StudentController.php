<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    //  1) получить список всех студентов
    public function getAll()
    {
        return Student::all();
    }

    public function set($data)
    {
        return '3) создать студента, 4) обновить студента (имя, принадлежность к классу)'.$data;
    }

    public function del($data)
    {
        return '5) удалить студента'.$data;
    }

    //  2) получить информацию о конкретном студенте (имя, email + класс + прослушанные лекции)
    public function info($data)
    {
        return Student::where('id', $data)->with('lectures')->get();
    }
}
