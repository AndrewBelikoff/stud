<?php

namespace App\Http\Controllers;

use App\Models\Lecture;
use Illuminate\Database\Eloquent\Builder;

class LectureController extends Controller
{
    //  13) получить список всех лекций
    public function getAll()
    {
        return Lecture::all();
    }

    public function set($data)
    {
        return '15) создать лекцию, 16) обновить лекцию (тема, описание)' . $data;
    }

    public function del($data)
    {
        return '17) удалить лекцию' . $data;
    }

    //  14) получить информацию о конкретной лекции (тема, описание + какие классы прослушали лекцию + какие студенты прослушали лекцию)
    public function info($data)
    {
        return Lecture::where('id', $data)
            ->with([
                'students' => function ($query) {
                    $query->where('is_completed', 1);
                },
                'groups'=> function ($query) use ($data) {
                    $query->whereDoesntHave('students', function (Builder $query) use ($data) {
                        $query->whereHas('studies', function (Builder $query) use ($data) {
                            $query->where('is_completed', 0)->where('lecture_id', $data);
                        });
                    });
                }])
            ->get();
    }
}
