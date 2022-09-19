<?php declare(strict_types=1);

namespace App\Service;

use App\Entity\Position;

class PositionsService
{
    /**
     * @return Position[]
     */
    public function getPositions(): array
    {
    }

    public function getPosition(int $positionId): Position
    {
    }

    public function addPosition(Position $newPosition): Position
    {
    }

    public function updatePosition(Position $existingPosition, Position $deserializedPosition): Position
    {
    }

    public function deletePosition(Position $positionToDelete): void
    {
    }
}
