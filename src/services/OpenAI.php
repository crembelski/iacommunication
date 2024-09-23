<?php

namespace crembelski\iacommunication\services;

use GuzzleHttp\Client;

class OpenAI implements ServicesInterface
{
    protected $url;
    protected $client;
    protected $apiKey;

    public function __construct($apiKey)
    {
        $this->client = new Client();
        $this->apiKey = $apiKey;
        $this->url = 'https://api.openai.com';
    }

    public function completions(string $message, string $model = null, int $max_token = null) : string
    {
        $model = $model ?? 'gpt-3.5-turbo-instruct';
        $max_token = $max_token ?? 1000;

        $response = $this->client->post($this->url . '/v1/completions', [
            'headers' => [
                'Authorization' => 'Bearer ' . $this->apiKey,
                'Content-Type' => 'application/json',
            ],
            'json' => [
                'model' => $model,
                'prompt' => $message,
                'max_tokens' => $max_token
            ],
        ]);

        $data = json_decode($response->getBody(), true);
        return $data['choices'][0]['text'] ?? 'Erreur in response of IA';
    }
}
