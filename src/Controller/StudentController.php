<?php

namespace App\Controller;

use App\Entity\Student;
use App\Form\StudentType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class StudentController extends AbstractController
{
    /**
     * @Route("/students", name="student_index")
     * @return Response
     */
    public function index(): Response
    {
        $students = $this->getDoctrine()->getRepository(Student::class)->findAll();

        $dateTime = new \DateTime();
        $dateTime->getTimestamp();
        dump($students, $dateTime);
        return $this->render('student/index.html.twig', [
            'students' => $students,
            'date_time' => $dateTime
        ]);
    }

    /**
     * @Route("/add", name="add_student")
     */
    public function add(Request $request)
    {
        $student = new Student();

        $form = $this->createForm(StudentType::class, $student);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {
            $student = $form->getData();
            $student->setCreatedAt(new \DateTime('now'));
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($student);
            $entityManager->flush();

            return $this->redirectToRoute('student_index');
        }

        return $this->render('student/add_student.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}