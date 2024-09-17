<?php

namespace draken\iacommunication;

use GuzzleHttp\Client;

class OpenAI extends IACommunication
{
    protected $url;

    public function __construct($apiKey)
    {
        $this->client = new Client();
        $this->apiKey = $apiKey;
        $this->url = 'https://api.openai.com/v1/completions';
    }

    public function sendMessage($message)
    {
        $response = $this->client->post($this->url, [
            'headers' => [
                'Authorization' => 'Bearer ' . $this->apiKey,
                'Content-Type' => 'application/json',
            ],
            'json' => [
                'model' => 'gpt-3.5-turbo-instruct',
                'prompt' => $message,
                'max_tokens' => 150
            ],
        ]);

        $data = json_decode($response->getBody(), true);
        return $data['choices'][0]['text'] ?? 'Erreur in response of IA';
    }
}
