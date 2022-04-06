<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use Illuminate\Http\Request;

class PlanController extends Controller
{
    //  8) получить учебный план (список лекций) для конкретного класса
    public function getPlan($data)
    {
        return Plan::all();
    }

    public function set($data)
    {
        return '9) создать/обновить учебный план (очередность и состав лекций) для конкретного класса: '.$data;
    }
}
