<?php

namespace App\Proxy;

use App\Proxy\Contract\TasksContract;

/**
 * Class TasksAbstract
 * @package App\Proxy
 */
abstract class TasksAbstract implements TasksContract
{
    protected ?array $tasks = null;


}
