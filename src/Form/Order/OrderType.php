<?php

namespace App\Form\Order;

use App\Service\BranchService;
use App\Service\CarService;
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
    private array $vehicles = ["BRAK" => null];

    public function __construct(BranchService $branchService, CarService $carService)
    {
        $branchesData = $branchService->getAllBranches();
        $carsData = $carService->getCarsByStatus('ACTIVE');

        foreach ($branchesData as $branch)
        {
            $label = $branch->getName() . ", " . $branch->getAddressFirstLine() . ", " . $branch->getPostCode() . " " . $branch->getCity();
            $value = $branch->getSlug();
            $this->branches += [$label => $value];
        }

        foreach ($carsData as $car)
        {
            $label =
                'ID: ' .$car->getId() . ', ' .
                $car->getBrand() . ' ' .
                $car->getModel() . ' (' .
                $car->getSegment() . '), ' .
                $car->getBodyType() . ', ' .
                $car->getFuel() . ', ' .
                'LICZBA MIEJSC ' . $car->getNumberOfSeats() . ', ' .
                'LICZBA DRZWI ' . $car->getNumberOfDoors() . ', ' .
                'VIN: ' . $car->getVin();
            $value = $car->getId();
            $this->vehicles += [$label => $value];
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
                'J' => 'J',
                'M' => 'M'
            ],
            'branches' => $this->branches,
            'vehicles' => $this->vehicles
        ]);
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
            ->add('status', ChoiceType::class, [
                'choices' => $options['statuses'],
                'label' => 'STATUS'
            ])
            ->add('proposedSegment', ChoiceType::class, [
                'choices' => $options['segments'],
                'label'=> 'Proponowany segment'
            ])
            ->add('bookedVehicle', ChoiceType::class, [
                'choices' => $options['vehicles']
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
            ->add('clientsData', TextType::class, [
                'label' => 'Dane klientów'
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