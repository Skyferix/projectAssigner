<?php

namespace App\Form;

use App\Entity\Project;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProjectType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title' , TextType::class,[
                'attr' => [
                    'class' => 'w-100',
                    'placeholder' => 'Enter title',
                ]
            ])
            ->add('group_number',null,[
                'attr' => [
                    'min' => 1,
                    'placeholder' => 'Enter number',
                    'class' => 'w-100'
                ],
                'label' => 'Group per project'
            ])
            ->add('student_number',null,[
                'attr' => [
                    'min' => 1,
                    'placeholder' => 'Enter number',
                    'class' => 'w-100'
                ],
                'label' => 'Student per group'
            ])
            ->add('submit', SubmitType::class,[
                'attr' => [
                    'class' => 'float-right btn btn-primary'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Project::class,
        ]);
    }
}
