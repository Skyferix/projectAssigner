<?php

namespace App\Controller;

use App\Entity\Project;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class StatusController extends AbstractController
{
    /**
     * @Route("/status/{id}", name="status")]
     */
    public function index(int $id, ManagerRegistry $doctrine): Response
    {
        $project = $doctrine->getRepository(Project::class)->find($id);
        return $this->render('status/status.html.twig',[
            'project' => $project
        ]);
    }
}
