<?php

namespace App\Service\Serializer;

use App\Entity\Color;

class ColorsSerializer
{
    public function serialize(Color $color): array
    {
        return $color->toArray();
    }

    public function deserialize(array $data): Color
    {

    }
}
