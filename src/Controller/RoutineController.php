<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Service\IAService;

class RoutineController extends AbstractController
{
    /**
     * @Route("/routine", name="app_routine")
     */
    public function index(Request $request): JsonResponse
    {
        $srv = new IAService();
        $question = $request->get('question');

        return $this->json([
            'response' => $srv->connect($question),
        ]);
    }
}
/*
    "RoutineForm": {
        "days": "1;3;5",
        "office_start": "0800",
        "office_end": "1800",
        "use_public_transport": false,
        "workout": "txt"
    }
     */