<?php

namespace App\Service;


use App\Entity\Developer;
use App\Entity\Task;
use App\Exception\InvalidArgumentException;
use App\Procedure\AssignTaskProcedure;
use App\Procedure\StoreTaskProcedureContract;
use App\Proxy\Contract\TasksContract;
use App\Repository\TaskRepositoryContract;
use App\Service\Contract\TaskServiceContract;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\DecodingExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

/**
 * Class TaskService
 * @package App\Service
 */
class TaskService implements TaskServiceContract
{

    /** @var TasksContract */
    private TasksContract $tasksContract;

    /** @var AssignTaskProcedure */
    private AssignTaskProcedure $assignTaskProcedure;

    /**
     * @var StoreTaskProcedureContract
     */
    private StoreTaskProcedureContract $storeTaskProcedureContract;

    /**
     * @var TaskRepositoryContract
     */
    private TaskRepositoryContract $taskRepositoryContract;

    /**
     * TaskService constructor.
     * @param TasksContract $tasksContract
     * @param StoreTaskProcedureContract $storeTaskProcedureContract
     * @param AssignTaskProcedure $assignTaskProcedure
     * @param TaskRepositoryContract $taskRepositoryContract
     */
    public function __construct(
        TasksContract $tasksContract,
        StoreTaskProcedureContract $storeTaskProcedureContract,
        AssignTaskProcedure $assignTaskProcedure,
        TaskRepositoryContract $taskRepositoryContract
    )
    {
        $this->tasksContract = $tasksContract;
        $this->assignTaskProcedure = $assignTaskProcedure;
        $this->storeTaskProcedureContract = $storeTaskProcedureContract;
        $this->taskRepositoryContract = $taskRepositoryContract;
    }

    /**
     * @throws ClientExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     */
    public function registerTasks()
    {
        $tasks = $this->tasksContract->getTasks();
        $this->storeTaskProcedureContract->handle($tasks);
    }

    /**
     * @param Task $task
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function storeTask(Task $task)
    {
        $this->taskRepositoryContract->save($task);
        $this->assignTaskProcedure->handle($task);
    }

    /**
     * @param Task $task
     * @param Developer $developer
     * @throws ORMException
     * @throws OptimisticLockException
     * @throws InvalidArgumentException
     */
    public function assignDeveloper(Task $task, Developer $developer)
    {
        $this->taskRepositoryContract->assignDeveloper($task, $developer);
    }
}
