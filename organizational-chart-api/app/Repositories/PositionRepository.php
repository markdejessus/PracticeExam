<?php

namespace App\Repositories;

use App\Models\Position;
use Illuminate\Database\Eloquent\Collection;

class PositionRepository
{
    public function getAll(array $filters = []): Collection
    {
        $query = Position::query();

        if (isset($filters['search'])) {
            $query->where('name', 'like', '%' . $filters['search'] . '%');
        }

        if (isset($filters['sort'])) {
            $query->orderBy('name', $filters['sort']);
        }

        return $query->get();
    }

    public function find(int $id): ?Position
    {
        return Position::find($id);
    }

    public function updateOrCreate(array $attributes, array $values = []): Position
    {
        return Position::updateOrCreate($attributes, $values);
    }

    public function update(int $id, array $data): bool
    {
        return Position::find($id)->update($data);
    }

    public function delete(int $id): bool
    {
        return Position::destroy($id);
    }
}
