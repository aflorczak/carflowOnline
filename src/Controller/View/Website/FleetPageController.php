<?php

namespace App\Controller\View\Website;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/flota')]
class FleetPageController extends AbstractController
{
    #[Route('', name: 'app_view_website_get-fleet-page-view', methods: ['GET'])]
    public function getFleetPage(): Response
    {
        return $this->render('website/view/fleetPage.html.twig', [
            "title" => "Flota"
        ]);
    }
}