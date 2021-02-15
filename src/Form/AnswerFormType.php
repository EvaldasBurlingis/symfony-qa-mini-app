<?php

namespace App\Form;

use App\Entity\Answer;
use Symfony\Component\Form\AbstractType;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class AnswerFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('content', CKEditorType::class, [
                'label' => 'Your answer',
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
            'data_class' => Answer::class,
            'csrf_protection' => true,
            'csrf_field_name' => '_token',
            'csrd_token_id'   => 'answer_item'
        ]);
    }
}
