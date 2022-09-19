<?php declare(strict_types=1);

namespace App\Controller;

use App\Service\PositionsService;
use App\Service\Serializer\PositionsSerializer;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PositionsController extends AbstractSoccerApiController
{


    public function __construct(private PositionsService $positionsService, private PositionsSerializer $positionsSerializer)
    {
    }

    #[Route(path: '/positions', name: 'positions_list_controller', methods: ['GET'])]
    public function getPositions(): JsonResponse
    {
        $positions = $this->positionsService->getPositions();

        $serializedPositions = [];

        foreach ($positions as $position) {
            $serializedPositions[] = $this->positionsSerializer->serialize($position);
        }

        return new JsonResponse($serializedPositions);
    }

    #[Route(path: '/positions/{positionId}', name: 'position_detail_controller', requirements: ['positionId' => '\d+'], methods: ['GET'])]
    public function getPosition(int $positionId): JsonResponse
    {
        $position = $this->positionsService->getPosition($positionId);

        return new JsonResponse($this->positionsSerializer->serialize($position));
    }

    #[Route(path: '/positions', name: 'position_add_controller', methods: ['POST'])]
    public function addPosition(Request $request): JsonResponse
    {
        $data = $this->getData($request);
        $newPosition = $this->positionsSerializer->deserialize($data);

        $this->positionsService->addPosition($newPosition);

        return new JsonResponse($this->positionsSerializer->serialize($newPosition), Response::HTTP_CREATED);
    }

    #[Route(path: '/positions/{positionId}', name: 'position_update_controller', requirements: ['positionId' => '\d+'], methods: ['UPDATE'])]
    public function updatePosition(Request $request, int $positionId): JsonResponse
    {
        $existingPosition = $this->positionsService->getPosition($positionId);

        $data = $this->getData($request);
        $deserializedPosition = $this->positionsSerializer->deserialize($data);

        $updatedPosition = $this->positionsService->updatePosition($existingPosition, $deserializedPosition);

        return new JsonResponse($this->positionsSerializer->serialize($updatedPosition));
    }

    #[Route(path: '/positions/{positionId}', name: 'position_delete_controller', requirements: ['positionId' => '\d+'], methods: ['DELETE'])]
    public function deletePosition(int $positionId): JsonResponse
    {
        $positionToDelete = $this->positionsService->getPosition($positionId);

        $this->positionsService->deletePosition($positionToDelete);

        return new JsonResponse(status: Response::HTTP_NO_CONTENT);
    }
}
