<?php

namespace App\Decorator;

use App\Entity\Task;
use App\Enum\ResourceEnum;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;

/**
 * Class TaskDecoratorV1
 * @package App\Decorator
 */
class TaskDecoratorV1
{
//    /**
//     * @param array $data
//     * @return Task
//     */
//    public function parseTask(array $data): Task
//    {
//        return new Task(null, $data['id'], $data['sure'], $data['zorluk']);
//    }

    /**
     * @return ResponseInterface
     * @throws TransportExceptionInterface
     */
    public function sendRequest(): ResponseInterface
    {
        $http = HttpClient::create();
        return $http->request('GET', ResourceEnum::mocky_V1);
    }
}
