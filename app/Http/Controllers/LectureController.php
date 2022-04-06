<?php

namespace App\Http\Controllers;

use App\Models\Lecture;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class LectureController extends Controller
{
    //  13) получить список всех лекций
    public function getAll()
    {
        return Lecture::all();
    }

    //  15) создать лекцию, 16) обновить лекцию (тема, описание)
    public function set(Request $request)
    {
        return Lecture::updateOrCreate(
            [
                'id' => $request->id
            ],
            [
                'title' => $request->title,
                'description' => $request->description
            ]);
    }

    //  17) удалить лекцию
    public function del(Request $request)
    {
        return Lecture::where('id',$request->id)->delete();
    }

    //  14) получить информацию о конкретной лекции (тема, описание + какие классы прослушали лекцию + какие студенты прослушали лекцию)
    public function info(Request $request)
    {
        return Lecture::where('id', $request->id)
            ->with([
                'students' => function ($query) {
                    $query->where('is_completed', 1);
                },
                'groups'=> function ($query) use ($request) {
                    $query->whereDoesntHave('students', function (Builder $query) use ($request) {
                        $query->whereHas('studies', function (Builder $query) use ($request) {
                            $query->where('is_completed', 0)->where('lecture_id', $request->id);
                        });
                    });
                }])
            ->get();
    }
}
