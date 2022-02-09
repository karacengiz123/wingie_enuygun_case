<?php

namespace App\Procedure;

use App\Entity\Task;

/**
 * Interface StoreTaskProcedureContract
 * @package App\Procedure
 */
interface StoreTaskProcedureContract
{
    /**
     * @param Task[]|array|null
     */
    public function handle(array $tasks);
}
