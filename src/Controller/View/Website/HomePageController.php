<?php

namespace App\Controller\View\Website;

use App\Service\CarService;
use App\Service\OrderService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomePageController extends AbstractController
{
    private CarService $carService;
    private OrderService $orderService;

    public function __construct(
        CarService $carService,
        OrderService $orderService
    )
    {
        $this->carService = $carService;
        $this->orderService = $orderService;
    }

    #[Route('/', name: 'app_view_website_get-home-page-view', methods: ['GET'])]
    public function getHomePage(): Response
    {
        $numberOfCars = $this->carService->getCarsNumberByStatus('ACTIVE');
        $numberOfRentedCars = $this->orderService->getOrdersNumberByStatus("IN_PROGRESS");

        return $this->render('website/view/homePage.html.twig', [
            "title" => "Strona główna",
            "aboutUs" => "Tutaj jakiś fajny opis kim jesteśmy, nasz krótka historia i ogólnie w pytkę.",
            "numberOfCars" => $numberOfCars,
            "numberOfRentedCars" => $numberOfRentedCars
        ]);
    }
}