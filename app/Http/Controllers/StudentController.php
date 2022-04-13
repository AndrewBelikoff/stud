<?php

namespace App\Http\Controllers;

use App\Http\Requests\StudentRequest;
use App\Services\StudentService;
use Exception;
use Illuminate\Http\JsonResponse;

class StudentController extends Controller
{
    protected $studentService;

    public function __construct(StudentService $studentService)
    {
        $this->studentService = $studentService;
    }

    //  1) получить список всех студентов
    public function getAll(): JsonResponse
    {
        try {
            $result = $this->studentService->getAll();
        } catch (Exception $e) {
            $result = $e;
        }
        return response()->json($result);
    }

    //  3) создать студента, 4) обновить студента (имя, принадлежность к классу)
    public function set(StudentRequest $request): JsonResponse
    {
        $validated = $request->validated();

        try {
            $result = $this->studentService->set($validated);
        } catch (Exception $e) {
            $result = $e;
        }
        return response()->json($result);
    }

    //  5) удалить студента
    public function del($id): JsonResponse
    {
        try {
            $result = $this->studentService->del($id);
        } catch (Exception $e) {
            $result = $e;
        }
        return response()->json($result);
    }

    //  2) получить информацию о конкретном студенте (имя, email + класс + прослушанные лекции)
    public function info($id): JsonResponse
    {
        try {
            $result = $this->studentService->info($id);
        } catch (Exception $e) {
            $result = $e;
        }
        return response()->json($result);
    }
}
