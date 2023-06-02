<?php

namespace App\Service;

use Orhanerday\OpenAi\OpenAi as OpenAi;

class IAService
{
    const lista_actividades_oficina = array(
        1 => "1. Beber 2 litros de agua (10 btc).",
        3 => "3. Meditar 30 minutos (25 btc).",
        5 => "5. Utilizar tarjeta (10 btc).",
        7 => "7. Llamar a un familiar (5 btc).",
        9 => "9. Comer saludable durante todo el dia (20 btc)."
    );
    const lista_actividades = array(
        2 => "2. Caminar 5000 pasos (35 btc).",
        4 => "4. Practicar un deporte (35 btc).",
        6 => "6. Ir al gimnasio (35 btc).",
        8 => "8. 1 hora de formación / un curso (30 btc)."
    );
    const lista_actividades_genericas = array(
        10 => "10. Meditar 45 minutos (35 btc).",
        11 => "11. Caminar 2500 pasos (20 btc).",
        12 => "12. 1/2 media hora de formación (15 btc).",
        13 => "13. Meditar 1h (40 btc).",
        14 => "14. Caminar 7500 pasos (30 btc).",
    );
    public $openAi;

    public function __construct()
    {
        $this->openAi = new OpenAi($_ENV['IA_KEY']);
        $this->openAi->setHeader(["Connection" => "keep-alive"]);
    }


    public function connect($actividades_eliminadas, $actividad_en_uso, $actividades_oficina = true, $numero_actividades)
    {
        $question = "Dada la lista de numeros, elige $numero_actividades numeros unicos, que no se repitan, separados por comas y no incluyas ninguna explicación, solo proporciona una respuesta";
        $lista_actividades = ($actividades_oficina) ? self::lista_actividades_oficina : self::lista_actividades;

        $lista_actividades = $lista_actividades + self::lista_actividades_genericas;

        unset($lista_actividades[$actividades_eliminadas]);
        foreach (explode(",", $actividad_en_uso) as $actividades) {
            unset($lista_actividades[$actividades]);
        }

        $listado_actividades = "";

        foreach ($lista_actividades as $key => $actividad) {
            $listado_actividades .= $key . "\n";
        }

        $chat = $this->openAi->chat([
            'model' => 'gpt-3.5-turbo',
            'messages' => [
                [
                    "role" => "system",
                    "content" => "Numeros disponibles:
                    $question
                    "
                ],
                [
                    "role" => "user",
                    "content" => $listado_actividades
                ]
            ],
            'temperature' => 1.0,
        ]);
        // decode response
        $d = json_decode($chat);
        // Get Content
        return str_replace('.', '', $d->choices[0]->message->content);
        //$response = preg_replace('/[^0-9]/', '', $response);
        //if (empty($listado_actividades[$response] || $listado_actividades[$response] == null)) {
        //    $this->connect($actividades_eliminadas, $actividad_en_uso);
        //}
        //return $response;
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
