<?php

namespace App\Form;

use App\Entity\Post;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PostType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('status', ChoiceType::class, [
                'choices' => [
                    'Hidden' => Post::STATUS_HIDDEN,
                    'Published' => Post::STATUS_PUBLISHED
                ]
            ])
            ->add('publishedAt', DateTimeType::class, [
                'widget' => 'choice',
                'input' => 'datetime'
            ])
            ->add('imageFile', FileType::class, [
                'mapped' => false,
                'required' => $options['require_image'],
            ])
            ->add('translations', CollectionType::class, [
                'entry_type' => PostTranslationType::class
            ])

            ->add('submit', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Post::class,
            'require_image' => true
        ]);

        $resolver->setAllowedTypes('require_image', 'bool');
    }
}
