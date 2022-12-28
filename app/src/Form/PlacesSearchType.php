<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class PlacesSearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('placeTitle', TextType::class, ['label' => 'Место', 'required' => false])
            ->add('packageTitle', TextType::class, ['label' => 'Упаковка', 'required' => false])
            ->add('search', SubmitType::class, ['label' => 'Найти'])
        ;
    }
}
