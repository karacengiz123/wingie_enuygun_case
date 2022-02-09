<?php

namespace App\Procedure;

use App\Procedure\AssignTaskProcedureContract;
use App\Entity\Task;
use App\Message\AssignTaskMessage;

/**
 * Class AssignTaskProcedure
 * @package App\Procedure
 */
class AssignTaskProcedure extends Procedure implements AssignTaskProcedureContract
{

    /**
     * @param Task $task
     */
    public function handle(Task $task)
    {
        $this->bus->dispatch(New AssignTaskMessage($task));
    }
}
