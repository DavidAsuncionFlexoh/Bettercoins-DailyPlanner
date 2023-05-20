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


    public function connect($actividades_eliminadas, $actividad_en_uso)
    {
        $question = "Dada la lista de actividades disponibles, elige 1 y responde solo su numero en la lista";

        $lista_actividades = array(
            "1" => "1. Caminar 5000 pasos (35 btc).",
            "2" => "2. Practicar un deporte (35 btc).",
            "3" => "3. Ir al gimnasio (35 btc).",
            "4" => "4. Beber 2 litros de agua (10 btc).",
            "5" => "5. Meditar 30 minutos (25 btc).",
            "6" => "6. Utilizar tarjeta (10 btc).",
            "7" => "7. Llamar a un familiar (5 btc).",
            "8" => "8. Comer saludable durante todo el dia (20 btc).",
            "9" => "9. 1 hora de formación / un curso (30 btc)."
        );

        unset($lista_actividades[$actividades_eliminadas]);
        foreach (explode(",", $actividad_en_uso) as $actividades) {
            unset($lista_actividades[$actividades]);
        }

        $listado_actividades = "";

        foreach ($lista_actividades as $actividad) {
            $listado_actividades .= $actividad . "\n";
        }

        $chat = $this->openAi->chat([
            'model' => 'gpt-3.5-turbo',
            'messages' => [
                [
                    "role" => "system",
                    "content" => "Actividades disponibles y sus btc:
                    $listado_actividades
                    "
                ],
                [
                    "role" => "user",
                    "content" => "$question"
                ],
                [
                    "role" => "system",
                    "content" => "Y devuelve unicamente su numero en la lista"
                ],
            ],
            'temperature' => 1.0,
        ]);
        // decode response
        $d = json_decode($chat);
        // Get Content
        $response = $d->choices[0]->message->content;
        $response = preg_replace('/[^0-9]/', '', $response);
        if ($response > 10) {
            $response  = substr($response, -1);
        }
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
