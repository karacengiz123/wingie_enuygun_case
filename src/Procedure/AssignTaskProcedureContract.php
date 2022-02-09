<?php

namespace App\Procedure;

use App\Entity\Task;

/**
 * Interface AssignTaskProcedureContract
 * @package App\Procedure
 */
interface AssignTaskProcedureContract
{
    /**
     * @param Task $task
     */
    public function handle(Task $task);
}
