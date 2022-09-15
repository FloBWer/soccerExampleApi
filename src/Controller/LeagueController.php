<?php declare(strict_types=1);

namespace App\Controller;

use App\Service\LeaguesService;
use App\Service\Serializer\LeaguesSerializer;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LeagueController extends AbstractSoccerApiController
{


    public function __construct(
        private LeaguesService $leaguesService,
        private LeaguesSerializer $leaguesSerializer,
    ) {}

    #[Route(path: '/leagues', name: 'leagues_list_controller', methods: ['GET'])]
    public function getLeagues(): JsonResponse
    {
        $leagues = $this->leaguesService->getLeagues();

        $serializedLeagues = [];
        foreach ($leagues as $league) {
            $serializedLeagues[] = $this->leaguesSerializer->serialize($league);
        }

        return new JsonResponse($serializedLeagues);
    }

    #[Route(path: '/leagues/{leagueId}', name: 'leagues_detail_controller', requirements: ['leagueId' => '\d+'], methods: ['GET'])]
    public function getLeague(int $leagueId): JsonResponse
    {
        $league = $this->leaguesService->getLeague($leagueId);

        return new JsonResponse($this->leaguesSerializer->serialize($league));
    }

    #[Route(path: '/leagues', name: 'leagues_add_controller', methods: ['POST'])]
    public function addLeague(Request $request): JsonResponse
    {
        $data = $this->getData($request);

        $newLeague = $this->leaguesSerializer->deserialize($data);

        $this->leaguesService->addLeague($newLeague);

        return new JsonResponse($this->leaguesSerializer->serialize($newLeague), Response::HTTP_CREATED);
    }

    #[Route(path: '/leagues/{leagueId}', name: 'leagues_update_controller', requirements: ['leagueId' => '\d+'], methods: ['PUT'])]
    public function updateLeague(Request $request, int $leagueId): JsonResponse
    {
        $existingLeague = $this->leaguesService->getLeague($leagueId);

        $data = $this->getData($request);
        $deserializeLeague = $this->leaguesSerializer->deserialize($data);

        $updatedLeague = $this->leaguesService->updateLeague($existingLeague, $deserializeLeague);

        return new JsonResponse($this->leaguesSerializer->serialize($updatedLeague));
    }

    #[Route(path: '/leagues/{leagueId}', name: 'leagues_detail_controller', requirements: ['leagueId' => '\d+'], methods: ['DELETE'])]
    public function deleteLeague(int $leagueId): JsonResponse
    {
        $leagueToDelete = $this->leaguesService->getLeague($leagueId);

        $this->leaguesService->deleteLeague($leagueToDelete);

        return new JsonResponse(Response::HTTP_NO_CONTENT);
    }
}
