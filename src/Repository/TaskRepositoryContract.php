<?php

namespace App\Repository;

use App\Exception\InvalidArgumentException;
use App\Entity\Developer;
use App\Entity\Task;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;

/**
 * Interface TaskRepositoryContract
 * @package App\Repository
 */
interface TaskRepositoryContract
{
    /**
     * @param Task $task
     * @param Developer $developer
     * @throws ORMException
     * @throws OptimisticLockException
     * @throws InvalidArgumentException
     */
    public function assignDeveloper(Task $task, Developer $developer);

    /**
     * @param Task $task
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function save(Task $task);
}
