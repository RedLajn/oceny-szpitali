<?php

namespace App\Form;

use App\Entity\Review;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ReviewType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('rating', ChoiceType::class, [
                'label' => 'Ocena',
                'choices' => [
                    '⭐ 1 - Bardzo źle' => 1,
                    '⭐⭐ 2 - Źle' => 2,
                    '⭐⭐⭐ 3 - Średnio' => 3,
                    '⭐⭐⭐⭐ 4 - Dobrze' => 4,
                    '⭐⭐⭐⭐⭐ 5 - Bardzo dobrze' => 5,
                ],
            ])
            ->add('comment', TextareaType::class, [
                'label' => 'Komentarz',
                'attr' => ['rows' => 5, 'placeholder' => 'Opisz swoją wizytę u lekarza...']
            ])
            ->add('authorName', TextType::class, [
                'label' => 'Twoje imię',
                'attr' => ['placeholder' => 'Jan Kowalski']
            ])
            ->add('authorEmail', EmailType::class, [
                'label' => 'Email',
                'attr' => ['placeholder' => 'jan@example.com']
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Review::class,
        ]);
    }
}
