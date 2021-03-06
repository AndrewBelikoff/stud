<?php

namespace App\Http\Controllers;

use App\Http\Requests\PlanRequest;
use App\Services\PlanService;
use Exception;
use Illuminate\Http\JsonResponse;

class PlanController extends Controller
{
    protected $planService;

    public function __construct(PlanService $planService)
    {
        $this->planService = $planService;
    }

    //  8) получить учебный план (список лекций) для конкретного класса
    public function getPlan($id): JsonResponse
    {
        try {
            $result = $this->planService->getPlan($id);
        } catch (Exception $e) {
            $result = $e;
        }
        return response()->json($result);
    }

    //  9) создать/обновить учебный план (очередность и состав лекций) для конкретного класса
    public function set(PlanRequest $request): JsonResponse
    {
        $validated = $request->validated();
        try {
            $result = $this->planService->setPlan($validated);
        } catch (Exception $e) {
            $result = $e;
        }
        return response()->json($result);
    }

    //  создание учебного плана для заданного класса (предыдущие планы удаляются)
    public function new(PlanRequest $request): JsonResponse
    {
        $validated = $request->validated();
        try {
            $result = $this->planService->newPlan($validated);
        } catch (Exception $e) {
            $result = $e;
        }
        return response()->json($result);
    }
}
