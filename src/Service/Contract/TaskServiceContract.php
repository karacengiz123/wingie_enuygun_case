<?php

namespace App\Service\Contract;

use App\Exception\InvalidArgumentException;
use App\Entity\Developer;
use App\Entity\Task;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\DecodingExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

/**
 * Interface TaskServiceContract
 * @package App\Service\Contract
 */
interface TaskServiceContract
{
    /**
     * @throws ClientExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     */
    public function registerTasks();

    /**
     * @param Task $task
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function storeTask(Task $task);

    /**
     * @param Task $task
     * @param Developer $developer
     * @throws ORMException
     * @throws OptimisticLockException
     * @throws InvalidArgumentException
     */
    public function assignDeveloper(Task $task, Developer $developer);
}
