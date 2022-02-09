<?php

namespace App\Service;

use App\Service\Contract\TaskServiceContract;
use App\Repository\DeveloperRepositoryContract;
use App\Service\Contract\DeveloperServiceContract;
use App\Exception\InvalidArgumentException;
use App\Entity\Task;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;

/**
 * Class DeveloperService
 * @package App\Service
 */
class DeveloperService implements DeveloperServiceContract
{
    /** @var DeveloperRepositoryContract */
    private DeveloperRepositoryContract $developerRepository;

    /** @var TaskServiceContract */
    private TaskServiceContract $taskService;

    /**
     * DeveloperService constructor.
     * @param DeveloperRepositoryContract $developerRepository
     * @param TaskServiceContract $taskService
     */
    public function __construct(DeveloperRepositoryContract $developerRepository, TaskServiceContract $taskService)
    {
        $this->developerRepository = $developerRepository;
        $this->taskService = $taskService;
    }

    /**
     * @return array
     */
    public function getDevelopers(): array
    {
        return $this->developerRepository->getAll();
    }

    /**
     * @param Task $task
     * @throws ORMException
     * @throws OptimisticLockException
     * @throws InvalidArgumentException
     */
    public function assignTask(Task $task)
    {
        $developer = $this->developerRepository->assignTask($task);
        try {
            $this->taskService->assignDeveloper($task, $developer);
        } catch (OptimisticLockException $e) {
            $this->developerRepository->deAssignTask($developer, $task);
        } catch (ORMException $e) {
            $this->developerRepository->deAssignTask($developer, $task);
        }
    }
}
