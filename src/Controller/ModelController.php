<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\IAService;

class ModelController extends AbstractController
{
    public $srv;
    public function __construct()
    {
        $this->srv = new IAService();
    }
    /**
     * @Route("/models", name="app_model")
     */
    public function models(): JsonResponse
    {
        return $this->json([
            'models' => $this->srv->listModels(),
        ]);
    }

    /**
     * @Route("/model/{model_id}", name="app_model_id")
     */
    public function model($model_id): JsonResponse
    {
        return $this->json([
            'models' => $this->srv->retrieveModel($model_id),
        ]);
    }
}
