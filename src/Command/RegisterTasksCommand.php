<?php

namespace App\Command;

use App\Service\TaskService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\DecodingExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

/**
 * Class RegisterTasksCommand
 * @package App\Command
 */
class RegisterTasksCommand extends Command
{



    /**
     * @var TaskService
     */
    private $taskService;

    /** @var string */
    protected static $defaultName = 'app:tasks:set:command';

    /**
     * RegisterTasksCommand constructor.
     * @param TaskService $taskService
     * @param string|null $name
     */
    public function __construct(TaskService $taskService, string $name = null)
    {
        $this->taskService = $taskService;
        parent::__construct($name);
    }


    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     * @throws ClientExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->taskService->registerTasks();

        $output->writeln(['Task Register Successfully']);


        return 0;
    }

}
