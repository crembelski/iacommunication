<?php

namespace crembelski\iacommunication\services;

interface ServicesInterface
{
    /**
     * Generate a completion for the given message.
     *
     * @param string $message The prompt message to generate a completion for.
     * @return string The generated completion response.
     * @throws InvalidArgumentException If the provided message is invalid.
     */
    public function completions(string $message): string;

    /**
     * Set the model to be used for the API request.
     *
     * @param string|null $model The model to be set.
     * @return self The instance of the class for method chaining.
     */
    public function setModel(?string $model): self;

    /**
     * Get the model used for the API request.
     *
     * @return string|null The current model.
     */
    public function getModel(): ?string;

    /**
     * Set the maximum number of tokens for the API response.
     *
     * @param int|null $max_token The maximum number of tokens to be set.
     * @return self The instance of the class for method chaining.
     */
    public function setMaxToken(?int $max_token): self;

    /**
     * Get the maximum number of tokens for the API response.
     *
     * @return int|null The current maximum number of tokens.
     */
    public function getMaxToken(): ?int;
}
