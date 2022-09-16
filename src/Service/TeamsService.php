<?php

namespace App\Service;

use App\Entity\Team;

class TeamsService
{
    /**
     * @return Team[]
     */
    public function getTeams(): array
    {

    }

    public function getTeam(int $teamId): Team
    {
    }

    public function addTeam(Team $newTeam): Team
    {
    }

    public function updateTeam(Team $existingTeam, Team $deserializedTeam): Team
    {
    }

    public function deleteTeam(Team $team): void
    {
    }
}
