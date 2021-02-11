<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

class QuestionController extends AbstractController
{
    public function __construct(
        private Environment $twig
    ) {}

    #[Route('/', name: 'questions.homepage')]
    public function homepage(): Response
    {
        return new Response($this->twig->render('landing/index.html.twig'));
    }

    #[Route('/questions/{slug}', name: 'questions.show')]
    public function show($slug)
    {
        return new Response($this->twig->render('questions/show.html.twig', [
            'question' => $slug 
        ]));
    }
}
