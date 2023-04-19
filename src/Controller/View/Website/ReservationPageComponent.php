<?php

namespace App\Controller\View\Website;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/rezerwacja')]
class ReservationPageComponent extends AbstractController
{
    #[Route('', name: 'app_view_website_get-reservation-page-view', methods: ['GET'])]
    public function getReservationPage(): Response
    {
        return $this->render('website/view/reservationPage.html.twig', [
            "title" => "Rezerwacja"
        ]);
    }
}