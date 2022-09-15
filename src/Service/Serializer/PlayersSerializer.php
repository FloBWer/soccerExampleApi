<?php declare(strict_types=1);

namespace App\Service\Serializer;

use App\Entity\Player;

class PlayersSerializer
{
    public function serialize(Player $player): array
    {
        return $player->toArray();
    }

    public function deserialize(array $data): Player
    {

    }
}
