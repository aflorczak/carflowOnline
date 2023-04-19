<?php

namespace App\Controller\View\Admin;

use App\Entity\Car;
use App\Form\Car\CarType;
use App\Service\CarService;
use Doctrine\DBAL\Types\IntegerType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route("/panel-administratora/cars")]
class CarViewAdminController extends AbstractController
{
    private CarService $service;

    public function __construct(CarService $service)
    {
        $this->service = $service;
    }

    #[Route("/new", name: "app_view_admin_cars_new-cars-view", methods: ['GET', 'POST'])]
    public function newCarsView(Request $request): Response
    {
        $car = new Car();
//        $car->setStatus("ACTIVE");
//        $car->setBrand("Opel");
//        $car->setModel("Calibra");
//        $car->setVin("11111111111111111");
//        $car->setMileage(214);
//        $car->setNumberOfSeats(5);
//        $car->setNumberOfDoors(5);
//        $car->setFuel("Pb95");
//        $car->setBodyType("CABRIO");
//        $car->setSegment("D");

        $form = $this->createForm(CarType::class, $car);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $car = $form->getData();

            $this->service->createNewCar($car);

            return $this->redirectToRoute('app_view_admin_cars_get-cars-view');
        }

        return $this->render('admin/view/car/newCar.html.twig', [
            "form" => $form->createView()
        ]);

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
                    $statusPl = "SAMOCHODY: AKTYWNE";
                    break;
                case "BLOCKED":
                    $statusPl = "SAMOCHODY: ZABLOKOWANE";
                    break;
                case "ARCHIVED":
                    $statusPl = "SAMOCHODY: ZARCHIWIZOWANE";
                    break;
            }

            $msg = $statusPl;
        }
        else
        {
            $cars = $this->service->getCarsByStatus();
            $counter = $this->service->getCarsNumberByStatus();
            $msg = "SAMOCHODY: WSZYSTKIE";
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

    #[Route('/{id}/edit', name: 'app_view_admin_cars_edit-car-by-id', methods: ['GET', 'POST'])]
    public function editCarById(int $id, Request $request): Response
    {
        $car = $this->service->getCarById($id);

        $form = $this->createForm(CarType::class, $car);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $car = $form->getData();

            $this->service->createNewCar($car);

            return $this->redirectToRoute('app_view_admin_cars_get-cars-view');
        }

        return $this->render('admin/view/car/editCar.html.twig', [
            "id" => $car->getId(),
            "form" => $form->createView()
        ]);
    }

    #[Route("/{id}/remove", name: "app_view_admin_cars_remove-car-by-id", methods: ['GET'])]
    public function removeCarById(int $id): Response
    {
        $this->service->deleteCarById($id);
        return $this->redirect('/panel-administratora/cars');
    }
}