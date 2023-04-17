<?php

namespace App\Controller\RestApi\V_0_0_1;

use App\Entity\Car;
use App\Service\CarService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route("/api/v-0_0_1/cars")]
class CarRestApiV_0_0_1Controller extends AbstractController
{
    private CarService $service;

    public function __construct(CarService $service)
    {
        $this->service = $service;
    }

    #[Route("/counter", name: "app_rest-api_v-0-0-1_cars_get-cars-number-with-status", methods: ['GET'], priority: 1)]
    public function getCarsNumber(Request $request): Response
    {
        $status = $request->query->get("status");

        if ($status)
        {
            $counter = $this->service->getCarsNumberByStatus($status);
            $msg = "Number of vehicles with status " . strtolower($status);
        }
        else
        {
            $counter = $this->service->getCarsNumberByStatus();
            $msg = "Number of all vehicles";
        }

        return $this->json([
            "data" => [
                $msg => $counter
            ]
        ],200);
    }

    #[Route("", name: "app_rest-api_v-0-0-1_cars_create-car", methods: ['POST'])]
    public function createCar(Request $request): Response
    {
        $data = json_decode($request->getContent(), true);

        $status = $data['status'];
        $brand = $data['brand'];
        $model = $data['model'];
        $vin = $data['vin'];
        $mileage = $data['mileage'];
        $fuel = $data['fuel'];
        $numberOfSeats = $data['numberOfSeats'];
        $numberOfDoors = $data['numberOfDoors'];
        $bodyType = $data['bodyType'];
        $segment = $data['segment'];

        // tutaj miejsce na funkcje walidacji

        $newCar = new Car();
        $newCar->setStatus($status);
        $newCar->setBrand($brand);
        $newCar->setModel($model);
        $newCar->setVin($vin);
        $newCar->setMileage($mileage);
        $newCar->setFuel($fuel);
        $newCar->setNumberOfSeats($numberOfSeats);
        $newCar->setNumberOfDoors($numberOfDoors);
        $newCar->setBodyType($bodyType);
        $newCar->setSegment($segment);

        $addedCar = $this->service->createNewCar($newCar);

        return $this->json([
            "data" => [
                "car" => $addedCar
            ]
        ], 201);
    }

    #[Route("", name: "app_rest-api_v-0-0-1_cars_get-cars", methods: ['GET'])]
    public function getCars(Request $request): Response
    {

        $status = $request->query->get("status");

        if ($status)
        {
            $cars = $this->service->getCarsByStatus($status);
        }
        else
        {
            $cars = $this->service->getCarsByStatus();
        }

        return $this->json([
            "data" => [
                "cars" => $cars
            ]
        ], 200);
    }

    #[Route("/{id}", name: "app_rest-api_v-0-0-1_cars_get-car-by-id", methods: ['GET'])]
    public function getCarById(int $id): Response
    {
        $car = $this->service->getCarById($id);

        return $this->json([
            "data" => [
                "car" => $car
            ]
        ], 200);
    }

    #[Route("/{id}", name: "app_rest-api_v-0-0-1_cars_update-car-by-id", methods: ['PUT'])]
    public function updateCarById(int $id, Request $request): Response
    {
        $data = json_decode($request->getContent(), true);

        $status = $data['status'];
        $brand = $data['brand'];
        $model = $data['model'];
        $vin = $data['vin'];
        $mileage = $data['mileage'];
        $fuel = $data['fuel'];
        $numberOfSeats = $data['numberOfSeats'];
        $numberOfDoors = $data['numberOfDoors'];
        $bodyType = $data['bodyType'];
        $segment = $data['segment'];

        // tutaj miejsce na funkcje walidacji

        $updateCar = new Car();
        $updateCar->setId($id);
        $updateCar->setStatus($status);
        $updateCar->setBrand($brand);
        $updateCar->setModel($model);
        $updateCar->setVin($vin);
        $updateCar->setMileage($mileage);
        $updateCar->setFuel($fuel);
        $updateCar->setNumberOfSeats($numberOfSeats);
        $updateCar->setNumberOfDoors($numberOfDoors);
        $updateCar->setBodyType($bodyType);
        $updateCar->setSegment($segment);

        $updatedCar = $this->service->updateCarById($updateCar);

        return $this->json([
            "data" => [
                "car" => $updatedCar
            ]
        ], 202);
    }

    #[Route("/{id}", name: "app_rest-api_v-0-0-1_cars_delete-car-by-id", methods: ['DELETE'])]
    public function deleteCarById(int $id): Response
    {
        $this->service->deleteCarById($id);

        return $this->json([], 204);
    }
}