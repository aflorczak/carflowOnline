<?php

namespace App\Form\Car;

use Doctrine\DBAL\Types\IntegerType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class CarType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('status', TextType::class)
            ->add('brand', TextType::class)
            ->add('model', TextType::class)
            ->add('vin', TextType::class)
            ->add('mileage', TextType::class) //d
            ->add('numberOfSeats', TextType::class) //d
            ->add('numberOfDoors', TextType::class) //d
            ->add('fuel', TextType::class)
            ->add('bodyType', TextType::class)
            ->add('segment', TextType::class)
            ->add('save', SubmitType::class, ['label' => 'Zapisz']);
    }
}