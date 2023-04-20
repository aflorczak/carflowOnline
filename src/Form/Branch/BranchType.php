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
            ->add('imgSrc', TextType::class, [
                'label' => "URL do zdjęcia"
            ])
            ->add('navLink', TextType::class, [
                'label' => 'URL linka nawigacyjnego'
            ])
            ->add('mapLink', TextType::class, [
                'label' => 'URL linka do mapy'
            ])
            ->add('email', TextType::class, [
                'label' => 'Email'
            ])
            ->add('phone', TextType::class, [
                'label' => 'Numer telefonu'
            ])
            ->add('save', SubmitType::class, ['label' => 'Zapisz']);
    }
}