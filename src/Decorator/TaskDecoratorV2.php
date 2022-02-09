<?php

namespace App\Decorator;

use App\Enum\ResourceEnum;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;

/**
 * Class TaskDecoratorV2
 * @package App\Decorator
 */
class TaskDecoratorV2
{
    /**
     * @return ResponseInterface
     * @throws TransportExceptionInterface
     */
    public function sendRequest(): ResponseInterface
    {
        $http = HttpClient::create();
        return $http->request('GET', ResourceEnum::mocky_V2);
    }
}
