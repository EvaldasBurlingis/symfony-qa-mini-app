<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Validator\Constraints\NotEqualTo;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', EmailType::class, [
                'label' => 'Email',                
                'label_attr' => ['class' => 'block text-xs text-blue-700 mb-1'],
                'attr' => ['class' => 'border border-2 rounded-sm border-blue-200 p-2 w-full'],
                'row_attr' => ['class' => 'mb-2']
            ])
            ->add('plainPassword', RepeatedType::class, [
                'type' => PasswordType::class,
                'mapped' => false,
                'required' => true,
                'invalid_message' => 'The passwords doesn\'t match',
                'first_options'  => [
                    'label' => 'Password',
                    'label_attr' => ['class' => 'block text-xs text-blue-700 mb-1'],
                    'attr' => ['class' => 'border border-2 rounded-sm border-blue-200 p-2 w-full'],
                    'row_attr' => ['class' => 'mb-2']
                ],
                'second_options' => [
                    'label' => 'Repeat Password',
                    'label_attr' => ['class' => 'block text-xs text-blue-700 mb-1'],
                    'attr' => ['class' => 'border border-2 rounded-sm border-blue-200 p-2 w-full'],
                    'row_attr' => ['class' => 'mb-2']
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a password',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Your password should be at least {{ limit }} characters',
                        'max' => 4096,
                    ])
                ],
            ])
            ->add('Save', SubmitType::class, [
                'attr' => ['class' => 'px-3 py-1 mr-2 bg-blue-600 text-blue-100 text-sm border border-blue-600 rounded-sm']
            ]);
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
