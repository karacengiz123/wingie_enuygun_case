<?php

namespace App\Controller;

use App\Decorator\TaskDecoratorV1;
use App\Decorator\TaskHandleV1;
use App\Repository\TaskRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TestController extends AbstractController
{
    /**
     * @Route("/test", name="test")
     */
    public function index(TaskRepository $taskRepository): Response
    {
        $a =$taskRepository->createTask();
        dump($a);
        exit();
        return $this->render('test/index.html.twig', [
            'controller_name' => 'TestController',
        ]);
    }
}
