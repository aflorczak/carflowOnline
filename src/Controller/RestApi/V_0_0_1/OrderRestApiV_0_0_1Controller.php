<?php

namespace App\Controller\RestApi\V_0_0_1;

use App\Entity\Order;
use App\Service\OrderService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route("/api/v-0_0_1/orders")]
class OrderRestApiV_0_0_1Controller extends AbstractController
{
    private OrderService $service;

    public function __construct(OrderService $service)
    {
        $this->service = $service;
    }

    #[Route("/counter", name: "app_rest-api_v-0-0-1_orders_get-orders-number-with-status", methods: ['GET'], priority: 1)]
    public function getOrdersNumber(Request $request): Response
    {
        $status = $request->query->get("status");

        if ($status)
        {
            $counter = $this->service->getOrdersNumberByStatus($status);
            $msg = "Number of orders with status " . strtolower($status);
        }
        else
        {
            $counter = $this->service->getOrdersNumberByStatus();
            $msg = "Number of all orders";
        }

        return $this->json([
            "data" => [
                $msg => $counter
            ]
        ],200);
    }

    #[Route("", name: "app_rest-api_v-0-0-1_orders_create-order", methods: ['POST'])]
    public function createOrder(Request $request): Response
    {
        $data = json_decode($request->getContent(), true);

        $status = $data['status'];
        $clientsData = $data['clientsData'];
        $principal = $data['principal'];
        $internalCaseNumber = $data['internalCaseNumber'];
        $externalCaseNumber = $data['externalCaseNumber'];
        $proposedSegment = $data['proposedSegment'];
        $deliveryAddress = $data['deliveryAddress'];
        $deliveryDate = date_create($data['deliveryDate']);
        $deliveryTime = date_create($data['deliveryTime']);
        $deliveryComments = $data['deliveryComments'];
        $deliveryBranch = $data['deliveryBranch'];
        $returnedAddress = $data['returnedAddress'];
        $returnedDate = date_create($data['returnedDate']);
        $returnedTime = date_create($data['returnedTime']);
        $returnedComments = $data['returnedComments'];
        $returnedBranch = $data['returnedBranch'];
        $reasonForCancellingTheOrder = $data['reasonForCancellingTheOrder'];

        // tutaj miejsce na funkcje walidacji

        $newOrder = new Order();
        $newOrder->setStatus($status);
        $newOrder->setClientsData($clientsData);
        $newOrder->setPrincipal($principal);
        $newOrder->setInternalCaseNumber($internalCaseNumber);
        $newOrder->setExternalCaseNumber($externalCaseNumber);
        $newOrder->setProposedSegment($proposedSegment);
        $newOrder->setDeliveryAddress($deliveryAddress);
        $newOrder->setDeliveryDate($deliveryDate);
        $newOrder->setDeliveryTime($deliveryTime);
        $newOrder->setDeliveryComments($deliveryComments);
        $newOrder->setDeliveryBranch($deliveryBranch);
        $newOrder->setReturnedAddress($returnedAddress);
        $newOrder->setReturnedDate($returnedDate);
        $newOrder->setReturnedTime($returnedTime);
        $newOrder->setReturnedComments($returnedComments);
        $newOrder->setReturnedBranch($returnedBranch);
        $newOrder->setReasonForCancellingTheOrder($reasonForCancellingTheOrder);

        $addedOrder = $this->service->createNewOrder($newOrder);

        return $this->json([
            "data" => [
                "order" => $addedOrder
            ]
        ], 201);
    }

    #[Route("", name: "app_rest-api_v-0-0-1_orders_get-orders", methods: ['GET'])]
    public function getOrders(Request $request): Response
    {

        $status = $request->query->get("status");

        if ($status)
        {
            $orders = $this->service->getOrdersByStatus($status);
        }
        else
        {
            $orders = $this->service->getOrdersByStatus();
        }

        return $this->json([
            "data" => [
                "orders" => $orders
            ]
        ], 200);
    }

    #[Route("/{id}", name: "app_rest-api_v-0-0-1_orders_get-order-by-id", methods: ['GET'])]
    public function getOrderById(int $id): Response
    {
        $order = $this->service->getOrderById($id);

        return $this->json([
            "data" => [
                "order" => $order
            ]
        ], 200);
    }

    #[Route("/{id}", name: "app_rest-api_v-0-0-1_orders_update-order-by-id", methods: ['PUT'])]
    public function updateOrderById(int $id, Request $request): Response
    {
        $data = json_decode($request->getContent(), true);

        $status = $data['status'];
        $clientsData = $data['clientsData'];
        $principal = $data['principal'];
        $internalCaseNumber = $data['internalCaseNumber'];
        $externalCaseNumber = $data['externalCaseNumber'];
        $proposedSegment = $data['proposedSegment'];
        $deliveryAddress = $data['deliveryAddress'];
        $deliveryDate = date_create($data['deliveryDate']);
        $deliveryTime = date_create($data['deliveryTime']);
        $deliveryComments = $data['deliveryComments'];
        $deliveryBranch = $data['deliveryBranch'];
        $returnedAddress = $data['returnedAddress'];
        $returnedDate = date_create($data['returnedDate']);
        $returnedTime = date_create($data['returnedTime']);
        $returnedComments = $data['returnedComments'];
        $returnedBranch = $data['returnedBranch'];
        $reasonForCancellingTheOrder = $data['reasonForCancellingTheOrder'];

        // tutaj miejsce na funkcje walidacji

        $updateOrder = new Order();
        $updateOrder->setId($id);
        $updateOrder->setStatus($status);
        $updateOrder->setClientsData($clientsData);
        $updateOrder->setPrincipal($principal);
        $updateOrder->setInternalCaseNumber($internalCaseNumber);
        $updateOrder->setExternalCaseNumber($externalCaseNumber);
        $updateOrder->setProposedSegment($proposedSegment);
        $updateOrder->setDeliveryAddress($deliveryAddress);
        $updateOrder->setDeliveryDate($deliveryDate);
        $updateOrder->setDeliveryTime($deliveryTime);
        $updateOrder->setDeliveryComments($deliveryComments);
        $updateOrder->setDeliveryBranch($deliveryBranch);
        $updateOrder->setReturnedAddress($returnedAddress);
        $updateOrder->setReturnedDate($returnedDate);
        $updateOrder->setReturnedTime($returnedTime);
        $updateOrder->setReturnedComments($returnedComments);
        $updateOrder->setReturnedBranch($returnedBranch);
        $updateOrder->setReasonForCancellingTheOrder($reasonForCancellingTheOrder);

        $updatedOrder = $this->service->updateOrderById($updateOrder);

        return $this->json([
            "data" => [
                "order" => $updatedOrder
            ]
        ], 202);
    }

    #[Route("/{id}", name: "app_rest-api_v-0-0-1_orders_delete-order-by-id", methods: ['DELETE'])]
    public function deleteOrderById(int $id): Response
    {
        $this->service->deleteOrderById($id);

        return $this->json([], 204);
    }

}