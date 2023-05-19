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
        $post_data = json_decode($request->getContent(), true);
        $srv = new IAService();
        //$srv->connect();
        print_r($srv->connect());

        return $this->json([
            'message' => $post_data,
            'path' => 'src/Controller/RoutineController.php',
        ]);
    }
}
