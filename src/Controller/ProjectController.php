<?php

namespace App\Controller;

use App\Entity\Group;
use App\Entity\Project;
use App\Form\ProjectType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/project', name: 'project')]
class ProjectController extends AbstractController
{
    #[Route('/', name: 'project')]
    public function index(): Response
    {
        return $this->render('project/index.html.twig', [
            'controller_name' => 'ProjectController',
        ]);
    }

    #[Route('/create', name: 'create')]
    public function create(Request $request, ManagerRegistry $doctrine):Response
    {
        $project = new Project();
        $form = $this->createForm(ProjectType::class, $project);

        $form->handleRequest($request);

        if($form->isSubmitted()){
            $entityManager = $doctrine->getManager();

            for($i = 0; $i <$project->getGroupNumber();$i++){
                $group = new Group();
                $entityManager->persist($group);

                $project->addGroup($group);
            }

            $entityManager->persist($project);
            $entityManager->flush();
            return $this->redirect('/status');
        }

        return $this->render('project/create.html.twig',[
            'form' => $form->createView()
        ]);
    }
}
