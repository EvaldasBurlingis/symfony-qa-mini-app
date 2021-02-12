<?php

namespace App\EntityListener;

use App\Entity\Question;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Symfony\Component\String\Slugger\SluggerInterface;

class QuestionEntityListener
{
    public function __construct(
        private SluggerInterface $slugger
    ) {}

    public function prePersist(Question $question, LifecycleEventArgs $event)
    {
        $question->computeSlug($this->slugger);
    }

    public function preUpdate(Question $question, LifecycleEventArgs $event)
    {
        $question->computeSlug($this->slugger);
    }
}