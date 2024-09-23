<?php

namespace crembelski\iacommunication;

use crembelski\iacommunication\services\OpenAI;
use crembelski\iacommunication\services\ServicesInterface;

class IACommunication
{
    protected ServicesInterface $service;

    /**
     * Constructor to initialize the class with the specified AI service and API key.
     *
     * @param string $iaService The name of the AI service to be used (e.g., 'OpenAI').
     * @param string $apiKey The API key used for authentication with the specified service.
     * @throws Exception If an invalid AI service is specified.
     */
    public function __construct(string $iaService, string $apiKey)
    {
        switch ($iaService) {
            case 'OpenAI':
                $this->service = new OpenAI($apiKey);
            break;
            default:
                throw new \Exception("Invalid value IA_SERVICE ($iaService) specified in configuration");
        }
    }

    /**
     * Generate a completion for the given message using the specified model.
     *
     * @param string $message The prompt message to generate a completion for.
     * @return string The generated completion response.
     */
    public function completions(string $message): string
    {
        return $this->service->completions($message);
    }

    /**
     * Get the service used for API requests.
     *
     * @return ServicesInterface The current service instance.
     */
    public function getService(): ServicesInterface
    {
        return $this->service;
    }
}
