<?php

namespace App\Controller;

use App\Repository\DeveloperRepository;
use App\Repository\TaskRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DeveloperController extends AbstractController
{
    /**
     * @var TaskRepository
     */
    private TaskRepository $taskRepository;
    /**
     * @var DeveloperRepository
     */
    private DeveloperRepository $developerRepository;

    public function __construct(TaskRepository $taskRepository,DeveloperRepository $developerRepository)
    {
        $this->taskRepository = $taskRepository;
        $this->developerRepository = $developerRepository;
    }

    /**
     * @Route("/developer", name="developer")
     */
    public function index(): Response
    {
        $datas = $this->developerRepository->findAll();
        return $this->render('developer/index.html.twig', [
            'datas' => $datas,
        ]);
    }
}
