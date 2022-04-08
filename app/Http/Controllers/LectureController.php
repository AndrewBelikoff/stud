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
    public function del($id)
    {
        return Lecture::findOrFail($id)->delete();
    }

    //  14) получить информацию о конкретной лекции (тема, описание + какие классы прослушали лекцию + какие студенты прослушали лекцию)
    public function info($id)
    {
        return Lecture::where('id', $id)
            ->with([
                'students' => function ($query) {
                    $query->where('is_completed', 1);
                },
                'groups'=> function ($query) use ($id) {
                    $query->whereDoesntHave('students', function (Builder $query) use ($id) {
                        $query->whereHas('studies', function (Builder $query) use ($id) {
                            $query->where('is_completed', 0)->where('lecture_id', $id);
                        });
                    });
                }])
            ->get();
    }
}
