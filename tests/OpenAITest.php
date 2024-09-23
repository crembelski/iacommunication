<?php

use crembelski\iacommunication\IACommunication;
use crembelski\iacommunication\services\OpenAI;
use PHPUnit\Framework\TestCase;

class OpenAITest extends TestCase
{

    public function tearDown(): void
    {
        Mockery::close();
    }

    public function test_completions()
    {
       // Créer un mock pour le service OpenAI
       $mockOpenAI = Mockery::mock(OpenAI::class);

       // Simuler un retour de la méthode completions
       $mockOpenAI->shouldReceive('completions')
           ->with('test of completion')
           ->andReturn('Mocked response from OpenAI');

       // Injecter ce mock dans IACommunication
       $IAC = new IACommunication(
           "OpenAI",
           "api_key"
       );

       // Utiliser reflection pour injecter directement le mock dans IACommunication
       $reflection = new \ReflectionClass(IACommunication::class);
       $property = $reflection->getProperty('service');
       $property->setAccessible(true);
       $property->setValue($IAC, $mockOpenAI);

       // Appeler la méthode et vérifier le résultat
       $response = $IAC->completions("test of completion");

       // Vérifier que la réponse est celle attendue
       $this->assertEquals('Mocked response from OpenAI', $response);
    }
}
