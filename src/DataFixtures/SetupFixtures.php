<?php

namespace App\DataFixtures;

use App\Entity\Project;
use App\Entity\Student;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class SetupFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $project = new Project();
        $project->setTitle('Test Project');
        $project->setGroupNumber(3);
        $project->setStudentNumber(3);

        $manager->persist($project);

        $student = new Student();
        $student->setName('John');
        $student->setSurname('Wick');
        $student->setProject($project);
        $manager->persist($student);

        $manager->flush();
    }
}
