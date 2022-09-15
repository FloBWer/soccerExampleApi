<?php declare(strict_types=1);

namespace App\Service\Serializer;

use App\Entity\League;

class LeaguesSerializer
{
    public function serialize(League $league): array
    {
        return $league->toArray();
    }

    public function deserialize(array $data): League
    {

    }
}
