<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class PingController extends AbstractController
{
    #[Route('/ping', name: 'ping', methods: 'GET')]
    public function ping(): JsonResponse
    {
        return new JsonResponse(['successful' => true]);
    }
}
