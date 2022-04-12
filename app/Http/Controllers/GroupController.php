<?php

namespace App\Http\Controllers;

use App\Http\Requests\GroupRequest;
use App\Services\GroupService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;

class GroupController extends Controller
{
    protected $groupService;

    public function __construct(GroupService $groupService)
    {
        $this->groupService = $groupService;
    }

    //  6) получить список всех классов
    public function getAll()
    {
        try {
            $result = $this->groupService->getAll();
        } catch (ModelNotFoundException $e) {
            $result = $e;
        }
        return response()->json($result);
    }

    //  10) создать класс, 11) обновить класс (название)
    public function set(GroupRequest $request): JsonResponse
    {
        $validated = $request->validated();
        try {
            $result = $this->groupService->set($validated);
        } catch (ModelNotFoundException $e) {
            $result = $e;
        }
        return response()->json($result);
    }

    //  12) удалить класс (при удалении класса, привязанные студенты должны открепляться от класса, но не удаляться полностью из системы)
    public function del($id): JsonResponse
    {
        try {
            $result = $this->groupService->del($id);
        } catch (ModelNotFoundException $e) {
            $result = $e;
        }
        return response()->json($result);
    }

    //  8) получить учебный план (список лекций) для конкретного класса
    public function info($id): JsonResponse
    {
        try {
            $result = $this->groupService->info($id);
        } catch (ModelNotFoundException $e) {
            $result = $e;
        }
        return response()->json($result);
    }
}
