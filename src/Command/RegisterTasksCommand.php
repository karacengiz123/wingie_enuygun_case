<?php

namespace App\Command;

use App\Repository\TaskRepository;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class RegisterTasksCommand
 * @package App\Command
 */
class RegisterTasksCommand extends Command
{

    /** @var string */
    protected static $defaultName = 'app:tasks:set:command';
    /**
     * @var TaskRepository
     */
    private TaskRepository $taskRepository;

    /**
     * RegisterTasksCommand constructor.
     * @param TaskRepository $taskRepository
     * @param string|null $name
     */
    public function __construct(TaskRepository $taskRepository, string $name = null)
    {
        parent::__construct($name);
        $this->taskRepository = $taskRepository;
    }


    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->taskRepository->createTask();

        $output->writeln(['Task Register Successfully']);
        return 0;
    }

}
