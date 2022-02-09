<?php

namespace App\Decorator\Contract;

use App\Entity\Task;

/**
 * Interface TaskParserDelegate
 * @package App\Decorator\Contract
 */
interface TaskParserDelegate
{

    /**
     * @param array $data
     * @return Task
     */
    public function parseTask(array $data): Task;
}
