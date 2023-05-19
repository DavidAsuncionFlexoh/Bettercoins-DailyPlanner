<?php

namespace App\Service;

use Orhanerday\OpenAi\OpenAi as OpenAi;

class IAService extends OpenAi
{
    public $openAi;

    public function __construct()
    {
        $this->openAi = new OpenAi('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');
    }
    public function connect()
    {

        $chat = $this->openAi->chat([
            'model' => 'gpt-3.5-turbo',
            'messages' => [
                [
                    "role" => "system",
                    "content" => "You are a helpful assistant."
                ],
                [
                    "role" => "user",
                    "content" => "Who won the world series in 2020?"
                ],
                [
                    "role" => "assistant",
                    "content" => "The Los Angeles Dodgers won the World Series in 2020."
                ],
                [
                    "role" => "user",
                    "content" => "Where was it played?"
                ],
            ],
            'temperature' => 1.0,
            'max_tokens' => 4000,
            'frequency_penalty' => 0,
            'presence_penalty' => 0,
        ]);


        var_dump($chat);
        echo "<br>";
        echo "<br>";
        echo "<br>";
        // decode response
        $d = json_decode($chat);
        // Get Content
        echo ($d->choices[0]->message->content);
    }
}
