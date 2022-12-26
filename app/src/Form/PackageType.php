<?php

namespace App\Form;

use App\Entity\Items;
use App\Repository\ItemsRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PackageType extends AbstractType
{
    public function __construct(private ItemsRepository $itemsRepository)
    {
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('qrCodeTitle',null, ['attr' => ['hidden' => 'hidden'], 'label' => false])
            ->add('item', EntityType::class, [
                'class' => Items::class,
                'choices' => $this->itemsRepository->findAllItemsAlphabetical(),
                'choice_label' => 'itemName',
                'placeholder' => 'Выберите компонент',
                'label' => 'Компонент'
            ])
            ->add('packageTitle', null, ['label' => 'Название упаковки'])
            ->add('createPackage', SubmitType::class, ['label' => 'Создать упаковку'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
