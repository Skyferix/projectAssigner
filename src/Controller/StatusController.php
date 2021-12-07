<?php

namespace App\Controller;

use App\Entity\Group;
use App\Entity\Project;
use Doctrine\Common\Collections\ArrayCollection;
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

        if(!$projects){
            return $this->render('create-project.html.twig');
        }

        $entityManager = $doctrine->getManager();
        if($request->isMethod("POST")){
            $request = $request->request->all();
            $projectTitle = $request['title'];
            $projectGroupNumber = $request['groupNumber'];
            $projectGroups = $request['groupStudentCount'];
            $project = new Project($projectTitle,$projectGroupNumber);
            foreach ($projectGroups as $group){
                $groupEntity = new Group(intval($group));
                $entityManager->persist($groupEntity);
                $project->addGroup($groupEntity);
            }
            $entityManager->persist($project);
            $entityManager->flush();
        }

        return $this->render('status.html.twig');
    }

//    public function submit(){
//        var
//    }
}
