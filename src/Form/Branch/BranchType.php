<?php

namespace App\Form\Branch;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class BranchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Nazwa'
            ])
            ->add('slug', TextType::class, [
                'label' => 'Slug'
            ])
            ->add('addressFirstLine', TextType::class, [
                'label' => 'Adres Pierwsza Linia'
            ])
            ->add('addressSecondLine', TextType::class, [
                'required' => false,
                'label' => "Adres Druga Linia"
            ])
            ->add('postCode', TextType::class, [
                'label' => 'Kod Pocztowy'
            ])
            ->add('city', TextType::class, [
                'label' => 'Miasto'
            ])
            ->add('save', SubmitType::class, ['label' => 'Zapisz']);
    }
}