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
        $actividades_eliminadas = $request->get('actividades_eliminadas');
        $actividad_en_uso = $request->get('actividad_en_uso');
        $actividades_oficina = $request->get('actividades_oficina');
        $numero_actividades = $request->get('numero_actividades');

        return $this->json([
            'response' => $srv->connect($actividades_eliminadas, $actividad_en_uso, $actividades_oficina, $numero_actividades),
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