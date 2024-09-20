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

    public function completions(string $message) : string
    {
        $response = $this->client->post($this->url . '/v1/completions', [
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
