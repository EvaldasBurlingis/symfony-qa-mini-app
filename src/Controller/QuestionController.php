<?php

namespace App\Controller;

use App\Entity\Question;
use App\Form\QuestionFormType;
use App\Repository\QuestionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class QuestionController extends AbstractController
{

    public function __construct(
        private EntityManagerInterface $entityManager,
        private QuestionRepository $questionRepository
    ) {}

    #[Route('/', name: 'questions.homepage')]
    public function homepage(): Response
    {
        return $this->render('landing/index.html.twig', [
            'questions' => $this->questionRepository->findNewestQuestions()
        ]);
    }

    #[Route('/questions', name: 'questions.index')]
    public function index(): Response
    {
        return $this->render('questions/index.html.twig');
    }

    #[Route('/questions/create', name: 'questions.create')]
    public function create(Request $request): Response
    {
        $question = new Question();
        $form = $this->createForm(QuestionFormType::class, $question);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $this->entityManager->persist($question);
            $this->entityManager->flush();

            return $this->redirectToRoute('questions.homepage');
        }
        
        return $this->render('questions/create.html.twig', [
            'question_form' => $form->createView()
        ]);
    }

    #[Route('/questions/{slug}', name: 'questions.show')]
    public function show($slug)
    {
        return $this->render('questions/show.html.twig', [
            'question' => $this->questionRepository->findOneBy(['slug' => $slug])
        ]);
    }
}
