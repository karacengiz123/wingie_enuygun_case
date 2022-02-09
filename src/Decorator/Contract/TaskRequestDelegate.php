<?php

namespace App\Decorator\Contract;

use Symfony\Contracts\HttpClient\ResponseInterface;

/**
 * Interface TaskRequestDelegate
 * @package App\Decorator\Contract
 */
interface TaskRequestDelegate
{
    /**
     * @return ResponseInterface
     */
    public function sendRequest(): ResponseInterface;
}
