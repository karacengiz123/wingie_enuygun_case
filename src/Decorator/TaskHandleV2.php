<?php

namespace App\Decorator;

use App\Entity\Task;
use App\Enum\ResourceEnum;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;

/**
 * Class TaskHandleV2
 * @package App\Decorator
 */
class TaskHandleV2
{
    /**
     * @var TaskDecoratorV2
     */
    private TaskDecoratorV2 $taskDecoratorV2;

    public function __construct(TaskDecoratorV2 $taskDecoratorV2)
    {

        $this->taskDecoratorV2 = $taskDecoratorV2;
    }

    public function v2ArrayDecorator()
    {
        $result = [];
        $data = $this->taskDecoratorV2->sendRequest()->toArray();
        foreach ($data as $key => $value) {
            foreach ($value as $key2 => $value2) {
                $result[]=[
                    "level"=>$value2["level"],
                    "estimated_duration"=>$value2["estimated_duration"],
                    "task"=>$key2,
                ];
            }
        }
        return $result;
    }
}
