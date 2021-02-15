<?php

namespace App\Form;

use App\Entity\Question;
use Symfony\Component\Form\AbstractType;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class QuestionFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, [
                'label' => 'Title',                
                'label_attr' => ['class' => 'block text-xs text-blue-700 mb-1'],
                'attr' => ['class' => 'border border-2 rounded-sm border-blue-200 p-2 w-full'],
                'row_attr' => ['class' => 'mb-2']
            ])
            ->add('content', CKEditorType::class, [
                'label' => 'Your Question',
                'label_attr' => ['class' => 'block text-xs text-blue-700 mb-1'],
                'attr' => ['class' => 'border border-2 rounded-sm border-blue-200 p-2 w-full'],
                'row_attr' => ['class' => 'mb-2']
            ])
            ->add('Save', SubmitType::class, [
                'attr' => ['class' => 'px-3 py-1 mr-2 bg-blue-600 text-blue-100 text-sm border border-blue-600 rounded-sm']
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class'      => Question::class,
            'csrf_protection' => true,
            'csrf_field_name' => '_token',
            'csrd_token_id'   => 'question_item'
        ]);
    }
    }
