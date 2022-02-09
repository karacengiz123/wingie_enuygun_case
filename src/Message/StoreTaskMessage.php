<?php

namespace App\Message;

use App\Entity\Task;

class StoreTaskMessage
{
    /** @var Task */
    private Task $task;

    /**
     * StoreTaskMessage constructor.
     * @param Task $task
     */
    public function __construct(Task $task)
    {
        $this->task = $task;
    }

    /**
     * @return Task
     */
    public function getTask(): Task
    {
        return $this->task;
    }
}
