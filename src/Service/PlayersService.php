<?php declare(strict_types=1);

namespace App\Service;

use App\Entity\Player;

class PlayersService
{
    /**
     * @return Player[]
     */
    public function getPlayers(): array
    {
    }

    public function getPlayer(int $playerId): Player
    {
    }

    public function addPlayer(Player $newPlayer): Player
    {

    }

    public function updatePlayer(Player $existingPlayer, Player $deserializedPlayer): Player
    {

    }

    public function deletePlayer(Player $playerToDelete): void
    {

    }
}
