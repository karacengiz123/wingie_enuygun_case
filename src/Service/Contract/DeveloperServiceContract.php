<?php

namespace App\Service\Contract;

use App\Exception\InvalidArgumentException;
use App\Entity\Task;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;

/**
 * Interface DeveloperServiceContract
 * @package App\Service\Contract
 */
interface DeveloperServiceContract
{
    /**
     * @return array
     */
    public function getDevelopers(): array;

    /**
     * @param Task $task
     * @throws ORMException
     * @throws OptimisticLockException
     * @throws InvalidArgumentException
     */
    public function assignTask(Task $task);
}
