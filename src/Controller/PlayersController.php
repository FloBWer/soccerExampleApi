<?php

namespace App\Controller;

use App\Service\PlayersService;
use App\Service\Serializer\PlayersSerializer;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PlayersController extends AbstractSoccerApiController
{


    public function __construct(private PlayersService $playersService, private PlayersSerializer $playersSerializer)
    {
    }

    #[Route(path: '/players', name: 'players_list_controller', methods: ['GET'])]
    public function getPlayers(): JsonResponse
    {
        $players = $this->playersService->getPlayers();

        $serializedPlayers = [];
        foreach ($players as $player) {
            $serializedPlayers[] = $this->playersSerializer->serialize($player);
        }

        return new JsonResponse($serializedPlayers);
    }

    #[Route(path: '/players/{playerId}', name: 'players_detail_controller', requirements: ['leagueId' => '\d+'], methods: ['GET'])]
    public function getPlayer(int $playerId): JsonResponse
    {
        $player = $this->playersService->getPlayer($playerId);

        return new JsonResponse($this->playersSerializer->serialize($player));
    }

    #[Route(path: '/players', name: 'players_add_controller', methods: ['POST'])]
    public function addPlayer(Request $request): JsonResponse
    {
        $data = $this->getData($request);

        $newPlayer = $this->playersSerializer->deserialize($data);

        $this->playersService->addPlayer($newPlayer);

        return new JsonResponse($this->playersSerializer->serialize($newPlayer), Response::HTTP_CREATED);
    }

    #[Route(path: '/players/{playerId}', name: 'players_update_controller', requirements: ['leagueId' => '\d+'], methods: ['PUT'])]
    public function updatePlayer(Request $request, int $playerId): JsonResponse
    {
        $existingPlayer = $this->playersService->getPlayer($playerId);

        $data = $this->getData($request);
        $deserializedPlayer = $this->playersSerializer->deserialize($data);

        $updatedPlayer = $this->playersService->updatePlayer($existingPlayer, $deserializedPlayer);

        return new JsonResponse($this->playersSerializer->serialize($updatedPlayer));
    }

    #[Route(path: '/players/{playerId}', name: 'players_delete_controller', requirements: ['leagueId' => '\d+'], methods: ['DELETE'])]
    public function deletePlayer(int $playerId): JsonResponse
    {
        $playerToDelete = $this->playersService->getPlayer($playerId);

        $this->playersService->deletePlayer($playerToDelete);

        return new JsonResponse(Response::HTTP_NO_CONTENT);
    }
}
