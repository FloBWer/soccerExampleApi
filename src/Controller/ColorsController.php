<?php declare(strict_types=1);

namespace App\Controller;

use App\Service\ColorsService;
use App\Service\Serializer\ColorsSerializer;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ColorsController extends AbstractSoccerApiController
{
    public function __construct(private ColorsService $colorsService, private ColorsSerializer $colorsSerializer)
    {
    }

    #[Route(path: '/colors', name: 'colors_list_controller', methods: ['GET'])]
    public function getColors(): JsonResponse
    {
        $colors = $this->colorsService->getColors();

        $serializedColors = [];
        foreach ($colors as $color) {
            $serializedColors[] = $this->colorsSerializer->serialize($color);
        }

        return new JsonResponse($serializedColors);
    }

    #[Route(path: '/colors/{colorId}', name: 'color_detail_controller', requirements: ['colorId' => '\d+'], methods: ['GET'])]
    public function getColor(int $colorId): JsonResponse
    {
        $color = $this->colorsService->getColor($colorId);

        return new JsonResponse($this->colorsSerializer->serialize($color));
    }

    #[Route(path: '/colors', name: 'color_add_controller', methods: ['POST'])]
    public function addColor(Request $request): JsonResponse
    {
        $data = $this->getData($request);
        $newColor = $this->colorsSerializer->deserialize($data);

        $this->colorsService->addColor($newColor);

        new JsonResponse($this->colorsSerializer->serialize($newColor), Response::HTTP_CREATED);
    }

    #[Route(path: '/colors/{colorId}', name: 'color_update_controller', requirements: ['colorId' => '\d+'], methods: ['UPDATE'])]
    public function updateColor(Request $request, int $colorId): JsonResponse
    {
        $existingColor = $this->colorsService->getColor($colorId);

        $data = $this->getData($request);
        $deserializedColor = $this->colorsSerializer->deserialize($data);

        $updatedColor = $this->colorsService->updateColor($existingColor, $deserializedColor);

        return new JsonResponse($this->colorsSerializer->serialize($updatedColor));

    }

    #[Route(path: '/colors/{colorId}', name: 'color_delete_controller', requirements: ['colorId' => '\d+'], methods: ['DELETE'])]
    public function deleteColor(int $colorId): JsonResponse
    {
        $colorToDelete = $this->colorsService->getColor($colorId);

        $this->colorsService->deleteColor($colorToDelete);

        return new JsonResponse($this->colorsSerializer->serialize($colorToDelete));
    }
}
