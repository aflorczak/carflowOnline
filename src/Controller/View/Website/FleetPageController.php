<?php

namespace App\Controller\View\Website;

use App\Service\CarService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/flota')]
class FleetPageController extends AbstractController
{
    private CarService $carService;

    public function __construct(CarService $carService)
    {
        $this->carService = $carService;
    }

    #[Route('', name: 'app_view_website_get-fleet-page-view', methods: ['GET'])]
    public function getFleetPage(): Response
    {
        return $this->render('website/view/fleetPage.html.twig', [
            "title" => "Flota"
        ]);
    }

    #[Route('/{class}', name: 'app_view_website_get-class-fleet-page-view', methods: ['GET'])]
    public function getClassFleetPage(string $class): Response
    {
        $class = strtoupper($class);
        $cars = $this->carService->getCarsByParams('ACTIVE', $class);

        return $this->render('website/view/classFleetPage.html.twig', [
            "title" => "Klasa: " . $class . " - FLOTA",
            "class" => $class,
            "cars" => $cars
        ]);
    }
}