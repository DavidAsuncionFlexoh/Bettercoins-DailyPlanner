<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class RoutineController extends AbstractController
{
    /**
     * @Route("/routine", name="app_routine")
     */
    public function index(Request $request): JsonResponse
    {
        $post_data = json_decode($request->getContent(), true);

        $form = $post_data['RoutineForm'];
        print_r($form);

        return $this->json([
            'message' => $post_data,
            'path' => 'src/Controller/RoutineController.php',
        ]);
    }
}
