<?php

namespace App\Controller;

use App\Entity\Project;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class StatusController extends AbstractController
{
    #[Route('/status', name: 'status')]
    public function index(ManagerRegistry $doctrine, Request $request): Response
    {
        $projects = $doctrine->getRepository(Project::class)->findAll();
        if($request->isMethod("POST")){
            if($request->get("title")==""){
                $this->addFlash('error', "Some of the fields are empty please check");
            }
        }
        if(!$projects){
            return $this->render('create-project.html.twig');
        }
        return $this->render('status.html.twig');
    }

//    public function submit(){
//        var
//    }
}
