<?php

namespace App\Controller;

use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CommentController extends AbstractController
{

    #[Route('/comments/{id<\d+>}/vote/{direction<up|down>}', methods: ['POST'])]
    public function commentVote($id, $direction, LoggerInterface $logger): Response
    {
        $currentVoteCount = rand(5, 100);

        if ($direction === 'up') {
            $logger->info('Voting up');
            $currentVoteCount++;
        }

        if ($direction === 'down') {
            $logger->info('Voting down');
            $currentVoteCount--;
        } 

        return $this->json(['votes' => $currentVoteCount], 200);
    }
}
