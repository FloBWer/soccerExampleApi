<?php declare(strict_types=1);

namespace App\Service;

use App\Entity\Color;

class ColorsService
{
    /**
     * @return Color[]
     */
    public function getColors(): array
    {
    }

    public function getColor(int $colorId): Color
    {
    }

    public function addColor(Color $color): Color
    {
    }

    public function updateColor(Color $existingColor, Color $deserializedColor): Color
    {
    }

    public function deleteColor(Color $colorToDelete): void
    {

    }
}
