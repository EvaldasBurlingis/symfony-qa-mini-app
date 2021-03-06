<?php

namespace App\Controller;

use App\Entity\Answer;
use App\Entity\Question;
use App\Form\AnswerFormType;
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

    #[Route('/questions/create', name: 'questions.create', methods: ['GET'])]
    public function create(): Response
    {
        $question = new Question();
        $form = $this->createForm(QuestionFormType::class, $question);

        return $this->render('questions/create.html.twig', [
            'question_form' => $form->createView()
        ]);
    }

    #[Route('/questions/{slug}', name: 'questions.show', methods: ['GET'])]
    public function show(Request $request, $slug)
    {
        $question = $this->questionRepository->findOneBy(['slug' => $slug]);

        $answer = new Answer();
        $form = $this->createForm(AnswerFormType::class, $answer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $answer->setQuestion($question);
            $answer->setVote(0);
            $this->entityManager->persist($answer);
            $this->entityManager->flush();

            return $this->redirectToRoute('questions.show', ['slug' => $slug]);
        }


        return $this->render('questions/show.html.twig', [
            'question'    => $question,
            'answer_form' => $form->createView()
        ]);
    }

    #[Route('/questions/create', name: 'questions.store', methods: ['POST'])]
    public function store(Request $request): Response
    {
        $question = new Question();
        $form = $this->createForm(QuestionFormType::class, $question);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $question->setOwner($this->getUser());
            $this->entityManager->persist($question);
            $this->entityManager->flush();

            return $this->redirectToRoute('questions.homepage');
        }
    }

    #[Route('/questions/{id}', name: 'questions.destroy', methods: ['DELETE'])]
    public function destroy(Request $request, $id)
    {
        $question = $this->questionRepository->find($id);

        if ($this->isCsrfTokenValid('delete-question' . $question->getId(), $request->request->get('_token')  )) {
            if($question->getOwner() !== $this->getUser()) {
                throw $this->createAccessDeniedException();
            }
    
            $this->entityManager->remove($question);
            $this->entityManager->flush();
    
            return $this->redirectToRoute('questions.homepage');
        }
    }
}
