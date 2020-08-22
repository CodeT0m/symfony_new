<?php

namespace App\DataFixtures;

use App\Entity\Student;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class StudentFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {

        $values = [
            [   'firstname' => 'Luke',
                'lastname' => 'Skywalker',
                'email' => 'luke.skywalker@therepublic.com'
            ],
            [
                'firstname' => 'Leia',
                'lastname' => 'Skywalker',
                'email' => 'leia.skywalker@therepublic.com'
            ],
            [
                'firstname' => 'Han',
                'lastname' => 'Solo',
                'email' => 'han.solo@therepublic.com'
            ],
            [
                'firstname' => 'Obi-wan',
                'lastname' => 'Kenobi',
                'email' => 'obi-wan.kenobi@therepublic.com'
            ]
        ];

        foreach ($values as $value) {
            $student = new Student();
            $student->setFirstname($value['firstname']);
            $student->setLastname($value['lastname']);
            $student->setEmail($value['email']);
            $student->setCreatedAt(new \DateTime('now'));

            $manager->persist($student);
        }

        $manager->flush();
    }
}
