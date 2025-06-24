<?php

namespace App\Services;

use App\Repositories\PositionRepository;
use Illuminate\Database\Eloquent\Collection;
use App\Models\Position;

class PositionService
{
    protected $positionRepository;

    public function __construct(PositionRepository $positionRepository)
    {
        $this->positionRepository = $positionRepository;
    }

    public function getAllPositions(array $filters = []): Collection
    {
        return $this->positionRepository->getAll($filters);
    }

    public function getPositionById(int $id): ?Position
    {
        return $this->positionRepository->find($id);
    }

    public function createPosition(array $data): Position
    {
        $attributes = ['name' => $data['name']];
        $values = ['reports_to' => $data['reports_to'] ?? null];

        return $this->positionRepository->updateOrCreate($attributes, $values);
    }

    public function updatePosition(int $id, array $data): bool
    {
        return $this->positionRepository->update($id, $data);
    }

    public function deletePosition(int $id): bool
    {
        return $this->positionRepository->delete($id);
    }
}
