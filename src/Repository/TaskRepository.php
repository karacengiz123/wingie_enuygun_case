<?php

namespace App\Repository;

use App\Repository\TaskRepositoryContract;
use App\Exception\InvalidArgumentException;
use App\Entity\Task;
use App\Entity\Developer;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping\ClassMetadata;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Task|null find($id, $lockMode = null, $lockVersion = null)
 * @method Task|null findOneBy(array $criteria, array $orderBy = null)
 * @method Task[]    findAll()
 * @method Task[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */

/**
 * Class TaskRepository
 * @package App\Repository
 */
class TaskRepository extends EntityRepository implements TaskRepositoryContract
{
    /** @var EntityManagerInterface */
    protected EntityManagerInterface $entityManager;

    /**
     * TaskRepository constructor.
     * @param EntityManagerInterface $entityManager
     * @param ClassMetadata $class
     */
    public function __construct(EntityManagerInterface $entityManager, ClassMetadata $class)
    {
        $this->entityManager = $entityManager;
        parent::__construct($entityManager, $class);
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
        $task->setDeveloper($developer);
        $this->save($task);
    }

    /**
     * @param Task $task
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function save(Task $task)
    {
        $this->_em->persist($task);
        $this->_em->flush();
    }
}
