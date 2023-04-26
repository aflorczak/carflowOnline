<?php

namespace App\Form\Car;

use App\Form\Order\OrderType;
use App\Service\BranchService;
use Doctrine\DBAL\Types\IntegerType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CarType extends AbstractType
{
    private array $branches = [];

    public function __construct(BranchService $branchService)
    {
        $branchesData = $branchService->getAllBranches();

        foreach ($branchesData as $branch)
        {
            $label = $branch->getName();
            $value = $branch->getName();
            $this->branches += [$label => $value];
        }
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'branches' => $this->branches,
        ]);
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('status', ChoiceType::class, [
                'choices' => [
                    'AKTYWNY' => 'ACTIVE',
                    'ZABLOKOWANY' => 'BLOCKED',
                    'ZARCHIWIZOWANY' => 'ARCHIVED'
                ]
            ])
            ->add('currentBranch', ChoiceType::class, [
                'choices' => $options['branches']
            ])
            ->add('brand', TextType::class)
            ->add('model', TextType::class)
            ->add('vin', TextType::class)
            ->add('mileage', TextType::class)
            ->add('numberOfSeats', ChoiceType::class, [
                'choices' => [
                    '1' => '1',
                    '2' => '2',
                    '3' => '3',
                    '4' => '4',
                    '5' => '5'
                ]
            ])
            ->add('numberOfDoors', ChoiceType::class, [
                'choices' => [
                    '1' => '1',
                    '2' => '2',
                    '3' => '3',
                    '4' => '4',
                    '5' => '5'
                ]
            ])
            ->add('fuel', ChoiceType::class, [
                'choices' => [
                    'ELEKTRYK' => 'ELECTRIC',
                    'PB95' => 'PB95',
                    'PB98' => 'PB98',
                    'DIESEL' => 'DIESEL',
                    'PB95 + LPG' => 'PB95 + LPG',
                    'PB98 + LPG' => 'PB98 + LPG',
                    'DIESEL + CNG' => 'DIESEL + CNG',
                ]
            ])
            ->add('bodyType', ChoiceType::class, [
                'choices' => [
                    'HATCHBACK' => 'HATCHBACK',
                    'COUPE' => 'COUPE',
                    'SEDAN' => 'SEDAN',
                    'KOMBI' => 'KOMBI',
                    'SUV' => 'SUV',
                    'CABRIO' => 'CABRIO',
                    'MINIVAN' => 'MINIVAN',
                    'VAN' => 'VAN'
                ]
            ])
            ->add('segment', ChoiceType::class, [
                'choices' => [
                    'A' => 'A',
                    'B' => 'B',
                    'C' => 'C',
                    'D' => 'D',
                    'J' => 'J',
                    'M' => 'M'
                ]
            ])
            ->add('save', SubmitType::class, ['label' => 'Zapisz']);
    }
}