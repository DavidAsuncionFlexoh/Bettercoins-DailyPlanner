<?php

namespace App\Service;

use Orhanerday\OpenAi\OpenAi as OpenAi;

class IAService
{
    public $openAi;

    public function __construct()
    {
        $this->openAi = new OpenAi($_ENV['IA_KEY']);
        $this->openAi->setHeader(["Connection" => "keep-alive"]);
    }


    public function connect($question)
    {
        $chat = $this->openAi->chat([
            'model' => 'gpt-3.5-turbo',
            'messages' => [
                [
                    "role" => "system",
                    "content" => "Actividades disponibles y sus btc:
                    1. Caminar 5000 pasos (35 btc).
                    2. Practicar un deporte (35 btc).
                    3. Ir al gimnasio (35 btc).
                    4. Beber 2 litros de agua (10 btc).
                    5. Meditar 30 minutos (25 btc).
                    6.Utilizar tarjeta (10 btc).
                    7.Llamar a un familiar (5 btc).
                    8.Comer saludable durante todo el dia (20 btc).
                    9. 1 hora de formación / un curso (30 btc).
                    "
                ],
                [
                    "role" => "user",
                    "content" => "$question"
                ]
            ],
            'temperature' => 1.0,
        ]);
        print($chat);
        // decode response
        $d = json_decode($chat);
        // Get Content
        return $d->choices[0]->message->content;
    }

    public function listModels()
    {
        return $this->openAi->listModels();
    }
    public function retrieveModel($model)
    {
        return $this->openAi->retrieveModel($model);
    }
}
