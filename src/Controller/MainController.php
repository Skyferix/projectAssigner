<?php

namespace App\Controller;

use App\Entity\Project;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class MainController extends AbstractController
{
    #[Route('/', name: 'main')]
    public function index(ManagerRegistry $doctrine, Request $request): Response
    {
        $projects = $doctrine->getRepository(Project::class)->findAll();

        if(!$projects){
            return $this->redirect('/project/create');
        }

        return $this->redirect('/status');
    }
}
