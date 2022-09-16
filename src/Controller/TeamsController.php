<?php

namespace App\Controller;

use App\Entity\Team;
use App\Service\Serializer\TeamsSerializer;
use App\Service\TeamsService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TeamsController extends AbstractSoccerApiController
{


    public function __construct(
        private TeamsService $teamsService,
        private TeamsSerializer $teamsSerializer
    ) {}

    #[Route(path: '/teams', name: 'teams_list_controller', methods: ['GET'])]
    public function getTeams(): JsonResponse
    {
        $teams = $this->teamsService->getTeams();

        $serializedTeams = [];

        foreach ($teams as $team) {
            $serializedTeams[] = $this->teamsSerializer->serialize($team);
        }

        return new JsonResponse($serializedTeams);
    }

    #[Route(path: '/teams/{teamId}', name: 'teams_detail_controller', requirements: ['teamId' => '\d+'], methods: ['GET'])]
    public function getTeam(int $teamId): JsonResponse
    {
        $team = $this->teamsService->getTeam($teamId);

        return new JsonResponse($this->teamsSerializer->serialize($team));
    }

    #[Route(path: '/teams', name: 'teams_add_controller', methods: ['POST'])]
    public function addTeam(Request $request): JsonResponse
    {
        $data = $this->getData($request);
        $newTeam = $this->teamsSerializer->deserialize($data);

        $this->teamsService->addTeam($newTeam);

        return new JsonResponse($this->teamsSerializer->serialize($newTeam), status: Response::HTTP_CREATED);
    }

    #[Route(path: '/teams{teamId', name: 'teams_update_controller', requirements: ['teamId' => '\d+'], methods: ['UPDATE'])]
    public function updateTeam(Request $request, int $teamId): JsonResponse
    {
        $existingTeam = $this->teamsService->getTeam($teamId);

        $data = $this->getData($request);
        $deserializedTeam = $this->teamsSerializer->deserialize($data);

        $updatedTeam = $this->teamsService->updateTeam($existingTeam, $deserializedTeam);

        return new JsonResponse($this->teamsSerializer->serialize($updatedTeam));
    }

    #[Route(path: '/teams/{teamId}', name: 'teams_delete_controller', requirements: ['teamId' => '\d+'],methods: ['DELETE'])]
    public function deleteTeam(int $teamId): JsonResponse
    {
        $team = $this->teamsService->getTeam($teamId);

        $this->teamsService->deleteTeam($team);

        return new JsonResponse(status: Response::HTTP_NO_CONTENT);
    }
}
