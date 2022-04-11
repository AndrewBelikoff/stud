<?php

namespace App\Http\Controllers;

use App\Http\Requests\LectureRequest;
use App\Models\Lecture;
use App\Services\LectureService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;

class LectureController extends Controller
{
    protected $lectureService;

    public function __construct(LectureService $lectureService)
    {
        $this->lectureService = $lectureService;
    }

    //  13) получить список всех лекций
    public function getAll(): JsonResponse
    {
        try {
            $result = $this->lectureService->getAll();
        } catch (ModelNotFoundException $e) {
            $result = $e;
        }
        return response()->json($result);
    }

    //  15) создать лекцию, 16) обновить лекцию (тема, описание)
    public function set(LectureRequest $request)
    {
        $validated = $request->validated();
        try {
            $result = $this->lectureService->set($validated);
        } catch (ModelNotFoundException $e) {
            $result = $e;
        }
        return response()->json($result);
    }

    //  17) удалить лекцию
    public function del($id)
    {
        return Lecture::findOrFail($id)->delete();
    }

    //  14) получить информацию о конкретной лекции (тема, описание + какие классы прослушали лекцию + какие студенты прослушали лекцию)
    public function info($id): JsonResponse
    {
        try {
            $result = $this->lectureService->info($id);
        } catch (ModelNotFoundException $e) {
            $result = '$e';
        }
        return response()->json($result);
    }
}
