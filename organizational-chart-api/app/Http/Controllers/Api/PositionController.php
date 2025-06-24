<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePositionRequest;
use App\Http\Requests\UpdatePositionRequest;
use App\Models\Position;
use App\Services\PositionService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PositionController extends Controller
{
    protected PositionService $positionService;

    public function __construct(PositionService $positionService)
    {
        $this->positionService = $positionService;
    }

    public function index(Request $request): JsonResponse
    {
        $filters = $request->only(['search', 'sort']);

        return response()->json($this->positionService->getAllPositions($filters));
    }

    public function store(StorePositionRequest $request): JsonResponse
    {
        $position = $this->positionService->createPosition($request->validated());

        return response()->json($position, 201);
    }

    public function show(Position $position): JsonResponse
    {
        return response()->json($position);
    }

    public function update(UpdatePositionRequest $request, Position $position): JsonResponse
    {
        $this->positionService->updatePosition($position->id, $request->validated());

        return response()->json($this->positionService->getPositionById($position->id));
    }

    public function destroy(Position $position): JsonResponse
    {
        $this->positionService->deletePosition($position->id);

        return response()->json(null, 204);
    }

    public function reportsTo(Position $position): JsonResponse
    {
        return response()->json($position->reportsTo()->first());
    }

    public function subordinates(Position $position): JsonResponse
    {
        return response()->json($position->subordinates()->get());
    }
}
