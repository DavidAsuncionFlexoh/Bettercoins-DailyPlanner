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
                    "role" => "user",
                    "content" => "$question"
                ]
            ],
            'temperature' => 1.0,
            'max_tokens' => 4000,
            'frequency_penalty' => 0,
            'presence_penalty' => 0,
        ]);
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
