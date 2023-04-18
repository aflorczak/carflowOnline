<?php

namespace App\Form\Order;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class OrderType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('status', ChoiceType::class, [
                'choices' => [
                    'NOWE' => 'NEW',
                    'W TRAKCIE REALIZACJI' => 'IN_PROGRESS',
                    'ZWRÓCONE, DO FAKTUROWANIA' => 'RETURNED',
                    'ZAKOŃCZONE' => 'ENDED',
                    'ANULOWANE' => 'CANCELLED'
                ],
                'label' => 'Status'
            ])
            ->add('clientsData', TextType::class, [
                'label' => 'Dane klientów'
            ])
            ->add('principal', ChoiceType::class, [
                'choices' => [
                    'CarFLOw - strona internetowa' => 'CFWEBSITE',
                    'PZU' => 'PZU',
                    'Link 4' => 'LINK4'
                ],
                'label' => 'Zleceniodawca'
            ])
            ->add('internalCaseNumber', TextType::class, [
                'label' => 'Wewnętrzny numer sprawy'
            ])
            ->add('externalCaseNumber', TextType::class, [
                'label' => 'Zewnętrzny numer sprawy'
            ])
            ->add('proposedSegment', ChoiceType::class, [
                'choices' => [
                    'A' => 'A',
                    'B' => 'B',
                    'C' => 'C',
                    'D' => 'D',
                    'SUV' => 'SUV'
                ],
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
                'choices' => [
                    'Wrocław Lotnisko, ul. Graniczna 190, 54-530 Wrocław, Polska' => 'wro-lot'
                ],
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
                'choices' => [
                    'Wrocław Lotnisko, ul. Graniczna 190, 54-530 Wrocław, Polska' => 'wro-lot'
                ],
                'label' => 'Oddział realizujący zwrot'
            ])
            ->add('reasonForCancellingTheOrder', TextType::class, [
                'required' => false,
                'label' => 'Powód anulacji'
            ])
            ->add('save', SubmitType::class, ['label' => 'Zapisz']);
    }
}