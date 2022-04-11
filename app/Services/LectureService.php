<?php

namespace App\Services;

use App\Models\Lecture;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class LectureService
{
    //  13) получить список всех лекций
    public function getAll(): Collection
    {
        return Lecture::all();
    }

    //  15) создать лекцию, 16) обновить лекцию (тема, описание)
    public function set(array $data): Lecture
    {
        if (array_key_exists('id', $data)) {
            return Lecture::updateOrCreate(
                [
                    'id' => $data['id']
                ],
                [
                    'title' => $data['title'],
                    'description' => $data['description']
                ]
            );
        } else {
            return Lecture::updateOrCreate(
                [
                    'title' => $data['title'],
                ],
                [
                    'description' => $data['description']
                ]
            );
        }
    }

    //  17) удалить лекцию
    public function del($id): bool
    {
        return Lecture::findOrFail($id)->delete();
    }

    //  14) получить информацию о конкретной лекции (тема, описание + какие классы прослушали лекцию + какие студенты прослушали лекцию)
    public function info($id): Collection
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
