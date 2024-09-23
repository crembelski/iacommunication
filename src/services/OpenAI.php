<?php

namespace crembelski\iacommunication\services;

use GuzzleHttp\Client;
use InvalidArgumentException;

class OpenAI implements ServicesInterface
{
    /**
     * The URL for the OpenAI API endpoint.
     *
     * @var string
     */
    protected $url;

    /**
     * The HTTP client used to make requests to the API.
     *
     * @var \GuzzleHttp\Client
     */
    protected $client;

    /**
     * The API key used for authentication with the OpenAI API.
     *
     * @var string
     */
    protected $apiKey;

    /**
     * The model used for generating completions or responses.
     *
     * @var string|null
     */
    protected ?string $model;

    /**
     * The maximum number of tokens to generate in the response.
     *
     * @var int|null
     */
    protected ?int $max_token;

    /**
     * Constructor to initialize the class with the provided API key.
     *
     * @param string $apiKey The API key used for authentication with the OpenAI API.
     */
    public function __construct($apiKey)
    {
        $this->client = new Client();
        $this->apiKey = $apiKey;
        $this->url = 'https://api.openai.com';
        $this->model = 'gpt-3.5-turbo-instruct';
        $this->max_token = 1000;
    }

    /**
     * Generate a completion for the given message using the specified model.
     *
     * @param string $message The prompt message to generate a completion for.
     * @return string The generated completion response.
     */
    public function completions(string $message): string
    {
        if (empty(trim($message))) {
            throw new InvalidArgumentException('The stored message is invalid.');
        }

        $response = $this->client->post($this->url . '/v1/completions', [
            'headers' => [
                'Authorization' => 'Bearer ' . $this->apiKey,
                'Content-Type' => 'application/json',
            ],
            'json' => [
                'model' => $this->model,
                'prompt' => $message,
                'max_tokens' => $this->max_token
            ],
        ]);

        $data = json_decode($response->getBody(), true);
        return $data['choices'][0]['text'] ?? 'Erreur in response of IA';
    }

    /**
     * Set the model to be used for the API request.
     *
     * @param string|null $model The model to be set.
     * @return self The instance of the class for method chaining.
     */
    public function setModel(?string $model): self
    {
        $this->model = $model;
        return $this;
    }

    /**
     * Get the model used for the API request.
     *
     * @return string|null The current model.
     */
    public function getModel(): ?string
    {
        return $this->model;
    }

    /**
     * Set the maximum number of tokens for the API response.
     *
     * @param int|null $max_token The maximum number of tokens to be set.
     * @return self The instance of the class for method chaining.
     */
    public function setMaxToken(?int $max_token): self
    {
        $this->max_token = $max_token;
        return $this;
    }

    /**
     * Get the maximum number of tokens for the API response.
     *
     * @return int|null The current maximum number of tokens.
     */
    public function getMaxToken(): ?int
    {
        return $this->max_token;
    }

}
