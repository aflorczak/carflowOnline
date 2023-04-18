<?php

namespace App\Service;

use App\Entity\Order;
use App\Repository\OrderRepository;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class OrderService
{
    private OrderRepository $repository;

    public function __construct(OrderRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getOrdersNumberByStatus(string $status = null): int
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

    public function createNewOrder(Order $order): Order
    {
        return $this->repository->save($order, true);
    }

    public function getOrdersByStatus(string $status = null): array
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

    public function getOrderById(int $id): Order
    {
        $order = $this->repository->findOneBy(["id" => $id]);

        if ($order)
        {
            return $order;
        }
        else
        {
            throw new NotFoundHttpException("Not Found");
        }
    }

    public function updateOrderById(Order $order): Order
    {
        $findedOrder = $this->repository->findOneBy(["id" => $order->getId()]);

        if ($findedOrder)
        {
            $findedOrder->setStatus($order->getStatus());
            $findedOrder->setClientsData($order->getClientsData());
            $findedOrder->setPrincipal($order->getPrincipal());
            $findedOrder->setInternalCaseNumber($order->getInternalCaseNumber());
            $findedOrder->setExternalCaseNumber($order->getExternalCaseNumber());
            $findedOrder->setProposedSegment($order->getProposedSegment());
            $findedOrder->setDeliveryAddress($order->getDeliveryAddress());
            $findedOrder->setDeliveryDate($order->getDeliveryDate());
            $findedOrder->setDeliveryTime($order->getDeliveryTime());
            $findedOrder->setDeliveryComments($order->getDeliveryComments());
            $findedOrder->setDeliveryBranch($order->getDeliveryBranch());
            $findedOrder->setReturnedAddress($order->getReturnedAddress());
            $findedOrder->setReturnedDate($order->getReturnedDate());
            $findedOrder->setReturnedTime($order->getReturnedTime());
            $findedOrder->setReturnedComments($order->getReturnedComments());
            $findedOrder->setReturnedBranch($order->getReturnedBranch());
            $findedOrder->setReasonForCancellingTheOrder($order->getReasonForCancellingTheOrder());

            return $this->repository->save($findedOrder, true);
        }
        else
        {
            throw new NotFoundHttpException("Not Found");
        }
    }

    public function deleteOrderByid(int $id): void
    {
        $orderForRemove = $this->repository->findOneBy(["id" => $id]);

        if ($orderForRemove)
        {
            $this->repository->remove($orderForRemove, true);
        }
        else
        {
            throw new NotFoundHttpException("Not Found");
        }
    }
}