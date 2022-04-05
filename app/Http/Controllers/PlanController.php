<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PlanController extends Controller
{
    public function getPlan($data){
        return '8) получить учебный план (список лекций) для конкретного класса '.$data;
    }

    public function set($data){
        return '9) создать/обновить учебный план (очередность и состав лекций) для конкретного класса: '.$data;
    }
}
