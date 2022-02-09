<?php

namespace App\Procedure;

use App\Procedure\StoreTaskProcedureContract;
use App\Entity\Task;
use App\Message\StoreTaskMessage;

/**
 * Class StoreTaskProcedure
 * @package App\Procedure
 */
class StoreTaskProcedure extends Procedure implements StoreTaskProcedureContract
{
    /**
     * @param Task[]|array|null
     */
    public function handle(array $tasks)
    {
        foreach ($tasks as $task){
            $this->bus->dispatch(New StoreTaskMessage($task));
        }
    }
}
