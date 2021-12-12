<?php

namespace App\Tests;

use App\Entity\Student;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\VarDumper\Test\VarDumperTestTrait;

class StudentTest extends WebTestCase
{
    use VarDumperTestTrait;

    /** @var EntityManagerInterface */
    private  $entityManager;

    protected function setUp(): void
    {
        $kernel = self::bootKernel();

//        Used to automatically create schema of memory database
//        DatabasePrimer::prime($kernel);

        $this->entityManager = $kernel->getContainer()->get('doctrine')->getManager();
    }

    /** @test */
    public function student_record_can_be_deleted_from_database(): void
    {
        // Setup
        $student = new Student();
        $student->setName('John');
        $student->setSurname('Wick');
        $this->entityManager->persist($student);

        // Do something
        $this->entityManager->flush();

        $studentRepository = $this->entityManager->getRepository(Student::class);

        $studentRecord = $studentRepository->findAll();
//        dd($studentRecord);
//        $studentId = $studentRecord->getId();

//        $client = static::createClient();
//        $client->xmlHttpRequest(
//            'POST',
//            '/student/delete/' . $studentId,
//        );
//        $this->assertResponseIsSuccessful();
    }
}
