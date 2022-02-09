<?php

namespace App\Proxy;

use App\Decorator\TaskDecoratorFactory;
use App\Proxy\Contract\TasksContract;
use App\Entity\Task;
use App\Decorator\Contract\TaskDecoratorContract;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\DecodingExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

/**
 * Class TasksSingleton
 * @package App\Application\Proxy
 */
final class TasksSingleton extends TasksAbstract implements TasksContract
{
    private static ?TasksSingleton $instance = null;
    private TaskDecoratorContract $taskDecorator;

    /**
     * TasksSingleton constructor.
     * @param TaskDecoratorContract $taskDecorator
     * @throws ClientExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     */
    private function __construct(TaskDecoratorContract $taskDecorator)
    {
        $this->taskDecorator = $taskDecorator;
        $this->tasks = $this->taskDecorator->getTasks();
    }

    /**
     * @return TasksSingleton|null
     * @throws ClientExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     */
    public static function getInstance(): ?TasksSingleton
    {
        if (self::$instance == null) {
            self::$instance = new TasksSingleton((new TaskDecoratorFactory())->createTaskDecoratorManager());
        }

        return self::$instance;
    }

    /**
     * @return Task[]|array|null
     * @throws ClientExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     */
    public function getTasks(): ?array
    {
        if ($this->tasks === null) {
            $this->tasks = $this->taskDecorator->getTasks();
        }

        return $this->tasks;
    }
}
