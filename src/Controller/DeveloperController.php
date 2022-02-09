<?php

namespace App\Controller;

use App\Service\Contract\DeveloperServiceContract;
use App\Service\TaskService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class DeveloperController
 * @package App\Controller
 * @Route("/developer")
 */
class DeveloperController extends AbstractController
{
    /** @var DeveloperServiceContract */
    private DeveloperServiceContract $developerService;
    /**
     * @var TaskService
     */
    private TaskService $taskService;

    public function __construct(DeveloperServiceContract $developerService,TaskService $taskService)
    {
        $this->developerService = $developerService;
        $this->taskService = $taskService;
    }

    /**
     * @Route("/",name="developer_list")
     * @return Response
     */
    public function index(): Response
    {
        return $this->render('developer/index.html.twig', [
            'datas' => $this->developerService->getDevelopers()
        ]);
    }
}
