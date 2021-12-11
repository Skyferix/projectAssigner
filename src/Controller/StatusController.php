<?php

namespace App\Controller;

use App\Entity\Project;
use App\Entity\Student;
use App\Form\StudentType;
use Doctrine\Persistence\ManagerRegistry;
use mysql_xdevapi\Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class StatusController extends AbstractController
{
    /**
     * @Route("/status/submit/{id}", name="submit")]
     */
    public function submit(int $id, Request $request,ManagerRegistry $doctrine){
        $project = $doctrine->getRepository(Project::class)->find($id);
        $student = new Student();
        $form = $this->createForm(StudentType::class, $student);

        $form->handleRequest($request);

        if($form->isSubmitted()){
            $entityManager = $doctrine->getManager();
            $student->setProject($project);

            $entityManager->persist($student);
            try {
                $entityManager->flush();
            } catch (\Exception $e){
                return $this->json([
                    'status' => $e->getMessage(),
                    'student_fullName' => $student->getFullName()
                ],444);
            }
        } else{
            return $this->json([
                'status' => 'not submitted form :-(',
            ]);
        }

        return $this->json([
            'status' => 'success',
        ]);
    }

    /**
     * @Route("/status/{id}", name="status")]
     */
    public function index(int $id, ManagerRegistry $doctrine, Request $request): Response
    {
        $project = $doctrine->getRepository(Project::class)->find($id);

        $student = new Student();
        $form = $this->createForm(StudentType::class, $student);

        $students = $project->getStudents();
        $groups = $project->getGroups();

        $selectStudents = $project->getStudentsWithoutGroup();

        return $this->render('status/status.html.twig',[
            'project' => $project,
            'students' => $students,
            'groups' => $groups,
            'selectStudents' => $selectStudents,
            'form' => $form->createView()
        ]);
    }


}
