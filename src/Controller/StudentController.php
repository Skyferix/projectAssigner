<?php

namespace App\Controller;

use App\Entity\Group;
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
/**
 * @Route("/student", name="student")]
 */
class StudentController extends AbstractController
{
    /**
     * @Route("/create/{id}", name="create")]
     */
    public function create(int $id, Request $request,ManagerRegistry $doctrine){
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
     * @Route("/add", name="add")]
     */
    public function add(ManagerRegistry $doctrine): Response
    {
        $groupId = $_POST['groupId'];
        $studentId = $_POST['studentId'];
        if($groupId && $studentId) {
            $group = $doctrine->getRepository(Group::class)->find($groupId);
            $student = $doctrine->getRepository(Student::class)->find($studentId);

            $entityManager = $doctrine->getManager();
            $student->setProjectGroup($group);

            $entityManager->persist($group);
            try {
                $entityManager->flush();
            } catch (\Exception $e) {
                $this->json(['status' => 'error', $e->getMessage()], 400);
            }
            return $this->json(['status' => 'success'], 200);
        } else {
            return $this->json(['status' => 'success'], 400);
        }
    }

    /**
     * @Route("/delete/{id}", name="delete")]
     */
    public function delete(int $id, ManagerRegistry $doctrine): Response
    {
        if ($id) {
            $entityManager = $doctrine->getManager();
            $student = $doctrine->getRepository(Student::class)->find($id);
            $entityManager->remove($student);
            try {
                $entityManager->flush();
            } catch (\Exception $e) {
                return $this->json(['status' => 'error', $e->getMessage()], 400);
            }
        } else {
            return $this->json(['status' => 'error', 'cause' => 'Not valid id'], 400);
        }

        return $this->json(['status' => 'success']);
    }


}
