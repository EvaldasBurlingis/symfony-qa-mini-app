<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class QuestionController extends AbstractController
{
    #[Route('/', name: 'questions.homepage')]
    public function homepage(): Response
    {
        return new Response('hello');
    }

    #[Route('/questions/{slug}', name: 'questions.show')]
    public function show($slug)
    {
        return new Response($slug);
    }
}
