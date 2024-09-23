<?php

namespace crembelski\iacommunication\services;

interface ServicesInterface
{
    public function completions(string $message, string|null $model, int|null $max_token): string;
}
