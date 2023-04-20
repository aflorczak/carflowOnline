<?php

namespace App\Service;

use App\Entity\Car;
use App\Repository\CarRepository;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class CarService
{
    private CarRepository $repository;

    public function __construct(CarRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getCarsNumberByStatus(string $status = null): int
    {
        $response = null;

        if ($status)
        {
            $response = $this->repository->count(["status" => $status]);
        }
        else
        {
            $response = $this->repository->count([]);
        }

        return $response;

    }

    public function createNewCar(Car $car): Car
    {
        return $this->repository->save($car, true);
    }

    public function getCarsByParams(string $status = null, string $class = null): array
    {
        $response = null;

        if ($status && $class)
        {
            $response = $this->repository->findBy(["status" => $status, "segment" => $class]);
        }
        else if($status && !$class)
        {
            $response = $this->repository->findBy(["status" => $status]);
        }
        else if (!$status && $class)
        {
            $response = $this->repository->findBy(["segment" => $class]);
        }
        else
        {
            $response = $this->repository->findAll();
        }

        return $response;

    }

    public function getCarsByStatus(string $status = null): array
    {
        $response = null;

        if ($status)
        {
            $response = $this->repository->findBy(["status" => $status]);
        }
        else
        {
            $response = $this->repository->findAll();
        }

        return $response;

    }

    public function getCarById(int $id): Car
    {
        $car = $this->repository->findOneBy(["id" => $id]);

        if ($car)
        {
            return $car;
        }
        else
        {
            throw new NotFoundHttpException("Not Found");
        }
    }

    public function updateCarById(Car $car): Car
    {
        $findedCar = $this->repository->findOneBy(["id" => $car->getId()]);

        if ($findedCar)
        {
            $findedCar->setStatus($car->getStatus());
            $findedCar->setBrand($car->getBrand());
            $findedCar->setModel($car->getModel());
            $findedCar->setVin($car->getVin());
            $findedCar->setMileage($car->getMileage());
            $findedCar->setNumberOfSeats($car->getNumberOfSeats());
            $findedCar->setNumberOfDoors($car->getNumberOfDoors());
            $findedCar->setFuel($car->getFuel());
            $findedCar->setBodyType($car->getBodyType());
            $findedCar->setSegment($car->getSegment());

            return $this->repository->save($findedCar, true);
        }
        else
        {
            throw new NotFoundHttpException("Not Found");
        }
    }

    public function deleteCarById(int $id): void
    {
        $carForRemove = $this->repository->findOneBy(["id" => $id]);

        if ($carForRemove)
        {
            $this->repository->remove($carForRemove, true);
        }
        else
        {
            throw new NotFoundHttpException("Not Found");
        }
    }
}