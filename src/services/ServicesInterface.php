<?php

namespace crembelski\iacommunication\services;

interface ServicesInterface
{
    public function completions(string $message, string $model, int $max_token): string;
}
