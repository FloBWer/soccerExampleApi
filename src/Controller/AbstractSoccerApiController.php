<?php declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class AbstractSoccerApiController extends AbstractController
{
    protected function getData(Request $request): array
    {
        return json_decode($request->getContent(), true);
    }
}
