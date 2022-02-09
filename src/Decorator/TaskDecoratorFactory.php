<?php

namespace App\Decorator;

use App\Enum\ResourceEnum;
use App\Decorator\Contract\TaskDecoratorContract;

/**
 * Class TaskDecoratorFactory
 * @package App\Decorator
 */
final class TaskDecoratorFactory
{
    /**
     * @return TaskDecoratorContract
     */
    public static function createTaskDecoratorManager(): TaskDecoratorContract
    {
        return new TaskDecoratorV1(new TaskDecoratorV2());
    }
}
