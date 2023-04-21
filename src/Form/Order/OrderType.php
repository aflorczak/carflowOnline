<?php

namespace App\Form\Order;

use App\Service\BranchService;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class OrderType extends AbstractType
{
    private array $branches = [];

    public function __construct(BranchService $service)
    {
        $branchesData = $service->getAllBranches();
        foreach ($branchesData as $branch)
        {
            $label = $branch->getName() . ", " . $branch->getAddressFirstLine() . ", " . $branch->getPostCode() . " " . $branch->getCity();
            $value = $branch->getSlug();
            $this->branches += [$label => $value];
        }
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'statuses' => [
                'NOWE' => 'NEW',
                'W TRAKCIE REALIZACJI' => 'IN_PROGRESS',
                'ZWRÓCONE, DO FAKTUROWANIA' => 'RETURNED',
                'ZAKOŃCZONE' => 'ENDED',
                'ANULOWANE' => 'CANCELLED'
            ],
            'principals' => [
                'CarFLOw - strona internetowa' => 'CFWEBSITE',
                'PZU' => 'PZU',
                'Link 4' => 'LINK4'
            ],
            'segments' => [
                'A' => 'A',
                'B' => 'B',
                'C' => 'C',
                'D' => 'D',
                'SUV' => 'SUV'
            ],
            'branches' => $this->branches
        ]);
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
            ->add('status', ChoiceType::class, [
                'choices' => $options['statuses'],
                'label' => 'STATUS'
            ])
            ->add('clientsData', TextType::class, [
                'label' => 'Dane klientów'
            ])
            ->add('principal', ChoiceType::class, [
                'choices' => $options['principals'],
                'label' => 'Zleceniodawca'
            ])
            ->add('internalCaseNumber', TextType::class, [
                'label' => 'Wewnętrzny numer sprawy'
            ])
            ->add('externalCaseNumber', TextType::class, [
                'label' => 'Zewnętrzny numer sprawy'
            ])
            ->add('proposedSegment', ChoiceType::class, [
                'choices' => $options['segments'],
                'label'=> 'Proponowany segment'
            ])
            ->add('deliveryAddress', TextType::class, [
                'label' => 'Adres wydania'
            ])
            ->add('deliveryDatetime', DateTimeType::class, [
                'label' => 'Data i godzina wydania'
            ])
            ->add('deliveryComments', TextType::class, [
                'label' => 'Komentarz do wydania'
            ])
            ->add('deliveryBranch', ChoiceType::class, [
                'choices' => $options['branches'],
                'label' => 'Oddział realizujący wydanie'
            ])
            ->add('returnedAddress', TextType::class, [
                'label' => 'Adres zwrotu'
            ])
            ->add('returnedDatetime', DateTimeType::class, [
                'label' => 'Data i godzina zwrotu'
            ])
            ->add('returnedComments', TextType::class, [
                'label' => 'Komentarz do zwrotu'
            ])
            ->add('returnedBranch', ChoiceType::class, [
                'choices' => $options['branches'],
                'label' => 'Oddział realizujący zwrot'
            ])
            ->add('reasonForCancellingTheOrder', TextType::class, [
                'required' => false,
                'label' => 'Powód anulacji'
            ])
            ->add('save', SubmitType::class, ['label' => 'Zapisz']);
    }
}