<?php

namespace App\Controller\View\Admin;

use App\Service\CarService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route("/admin/cars")]
class CarViewAdminController extends AbstractController
{
    private CarService $service;

    public function __construct(CarService $service)
    {
        $this->service = $service;
    }

    #[Route("", name: "app_view_admin_cars_get-cars-view", methods: ['GET'])]
    public function carsGetCarsView(Request $request): Response
    {
        $status = $request->query->get("status");

        if ($status)
        {
            $cars = $this->service->getCarsByStatus($status);
            $counter = $this->service->getCarsNumberByStatus($status);

            switch ($status)
            {
                case "ACTIVE":
                    $statusPl = "AKTYWNE POJAZDY";
                    break;
                case "BLOCKED":
                    $statusPl = "ZABLOKOWANE POJAZDY";
                    break;
                case "ARCHIVED":
                    $statusPl = "ZARCHIWIZOWANE POJAZDY";
                    break;
            }

            $msg = "Zakres: " . $statusPl;
        }
        else
        {
            $cars = $this->service->getCarsByStatus();
            $counter = $this->service->getCarsNumberByStatus();
            $msg = "Zakres: WSZYSTKIE POJAZDY";
        }

        return $this->render("admin/view/car/getCarsView.html.twig", [
            "cars" => $cars,
            "counter" => $counter,
            "msg" => $msg
        ]);

    }

    #[Route("/{id}", name: "app_view_admin_cars_get-car-details-view", methods: ['GET'])]
    public function carsGetCarDetailsView(int $id): Response
    {
        $car = $this->service->getCarById($id);

        return $this->render('admin/view/car/carDetails.html.twig', [
            "car" => $car
        ]);
    }

    #[Route("/{id}/remove", name: "app_view_admin_cars_remove-car-by-id", methods: ['GET'])]
    public function removeCarById(int $id): Response
    {
        $this->service->deleteCarById($id);
        return $this->redirect('/admin/cars');
    }
}