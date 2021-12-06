<?php

namespace App\Controller;

use App\Entity\Project;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class StatusController extends AbstractController
{
    #[Route('/status', name: 'status')]
    public function index(ManagerRegistry $doctrine): Response
    {
//        $project = $doctrine->getRepository(Project::class)->find();
//        if(!$project){
//            return
//        }
        return $this->render('status.html.twig');
    }
}
