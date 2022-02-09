<?php

namespace App\Repository;

use App\Decorator\TaskHandleV1;
use App\Decorator\TaskHandleV2;
use App\Entity\Developer;
use App\Entity\Task;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Task|null find($id, $lockMode = null, $lockVersion = null)
 * @method Task|null findOneBy(array $criteria, array $orderBy = null)
 * @method Task[]    findAll()
 * @method Task[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TaskRepository extends ServiceEntityRepository
{
    /**
     * @var ManagerRegistry
     */
    private ManagerRegistry $registry;
    /**
     * @var EntityManagerInterface
     */
    private EntityManagerInterface $em;
    /**
     * @var TaskHandleV1
     */
    private TaskHandleV1 $taskHandleV1;
    /**
     * @var TaskHandleV2
     */
    private TaskHandleV2 $taskHandleV2;

    public function __construct(ManagerRegistry $registry, EntityManagerInterface $em,TaskHandleV1 $taskHandleV1,TaskHandleV2 $taskHandleV2)
    {
        parent::__construct($registry, Task::class);
        $this->registry = $registry;
        $this->em = $em;
        $this->taskHandleV1 = $taskHandleV1;
        $this->taskHandleV2 = $taskHandleV2;
    }
    public function createTask()
    {
        $em = $this->em;
        $result = ["success" => false, "message" => "No Action Taken"];
        try {
            foreach ($this->taskHandleV1->v1ArrayDecorator() as $v1){
                $newTask = new Task();
                $newTask
                    ->setTitle($v1["id"])
                    ->setLevel($v1["zorluk"])
                    ->setEstimated($v1["sure"])
                    ->setDeveloper($em->find(Developer::class,$v1["zorluk"]));
                $em->persist($newTask);
            }
            foreach ($this->taskHandleV2->v2ArrayDecorator() as $v2){
                $newTask = new Task();
                $newTask
                    ->setTitle($v2["task"])
                    ->setLevel($v2["level"])
                    ->setEstimated($v2["estimated_duration"])
                    ->setDeveloper($em->find(Developer::class,$v2["level"]));
                $em->persist($newTask);
            }
            $em->flush();
            $result["success"] = true;
            $result["message"] = "success";
        } catch (\Exception $e) {
            $result["success"] = false;
            $result["message"] = $e->getMessage();
        }
        return $result;
    }
}
