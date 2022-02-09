<?php

namespace App\Decorator;

use App\Decorator\TaskDecoratorContractImp;
use App\Entity\Task;
use App\Enum\ResourceEnum;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;

/**
 * Class TaskDecoratorV2
 * @package App\Decorator
 */
class TaskDecoratorV2 extends TaskDecorator implements TaskDecoratorContractImp
{
    /**
     * @param array $data
     * @return Task
     */
    public function parseTask(array $data): Task
    {
        return new Task(
            null,
            array_keys($data)[0],
            $data[array_keys($data)[0]]['estimated_duration'],
            $data[array_keys($data)[0]]['level']
        );
    }

    /**
     * @return ResponseInterface
     * @throws TransportExceptionInterface
     */
    public function sendRequest(): ResponseInterface
    {
        $http = HttpClient::create();
        return $http->request('GET', ResourceEnum::RESOURCE_V2);
    }
}
