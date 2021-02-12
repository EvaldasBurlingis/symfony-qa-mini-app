<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class QuestionController extends AbstractController
{

    #[Route('/', name: 'questions.homepage')]
    public function homepage(): Response
    {
        return $this->render('landing/index.html.twig');
    }

    #[Route('/questions', name: 'questions.index')]
    public function index(): Response
    {
        return $this->render('questions/index.html.twig');
    }

    #[Route('/questions/{slug}', name: 'questions.show')]
    public function show($slug)
    {
        return $this->render('questions/show.html.twig', [
            'question' => $slug 
        ]);
    }
}
