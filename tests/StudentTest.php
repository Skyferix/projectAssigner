<?php

namespace App\Tests;

use App\Entity\Student;
use App\Repository\StudentRepository;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class StudentTest extends WebTestCase
{
    /** @test */
    public function success_delete_from_db(): void
    {
        // Setup
        $studentRepository = static::getContainer()->get(StudentRepository::class);

        /** @var Student */
        $student = $studentRepository->findOneByName('John');

        // Do something
        self::ensureKernelShutdown();
        $client = static::createClient();
        $client->request(
            'POST',
            '/student/delete/' . $student->getId()
        );
        $this->assertResponseIsSuccessful();
    }

}
