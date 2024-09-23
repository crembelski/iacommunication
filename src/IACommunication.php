<?php

namespace crembelski\iacommunication;

use crembelski\iacommunication\services\OpenAI;
use crembelski\iacommunication\services\ServicesInterface;

class IACommunication implements ServicesInterface
{
    protected ServicesInterface $service;

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

    public function completions(string $message, string $model = null, int $max_token = null): string
    {
        return $this->service->completions($message, $model, $max_token);
    }
}
