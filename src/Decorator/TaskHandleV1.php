<?php

namespace App\Decorator;

use App\Entity\Task;
use App\Enum\ResourceEnum;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;

/**
 * Class TaskHandleV1
 * @package App\Decorator
 */
class TaskHandleV1
{
    /**
     * @var TaskDecoratorV1
     */
    private TaskDecoratorV1 $taskDecoratorV1;

    public function __construct(TaskDecoratorV1 $taskDecoratorV1)
    {

        $this->taskDecoratorV1 = $taskDecoratorV1;
    }

    public function v1ArrayDecorator()
    {
        return $this->taskDecoratorV1->sendRequest()->toArray();
    }
}
