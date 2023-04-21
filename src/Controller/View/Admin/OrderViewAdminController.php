<?php

namespace App\Controller\View\Admin;

use App\Entity\Order;
use App\Form\Order\OrderType;
use App\Service\BranchService;
use App\Service\OrderService;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route("/panel-administratora/orders")]
class OrderViewAdminController extends AbstractController
{
    private OrderService $service;

    public function __construct(OrderService $service)
    {
        $this->service = $service;
    }

    #[Route("/new", name: "app_view_admin_orders_new-orders-view", methods: ['GET', 'POST'])]
    public function newOrdersView(Request $request): Response
    {
        $order = new Order();


        $form = $this->createForm(OrderType::class, $order);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $order = $form->getData();

            $this->service->createNewOrder($order);

            return $this->redirectToRoute('app_view_admin_orders_get-orders-view');
        }

        return $this->render('admin/view/order/newOrder.html.twig', [
            "form" => $form->createView()
        ]);

    }

    #[Route("", name: "app_view_admin_orders_get-orders-view", methods: ['GET'])]
    public function ordersGetOrdersView(Request $request): Response
    {
        $status = $request->query->get("status");

        if ($status)
        {
            $orders = $this->service->getOrdersByStatus($status);
            $counter = $this->service->getOrdersNumberByStatus($status);

            switch ($status)
            {
                case "NEW":
                    $statusPl = "ZLECENIA: NOWE";
                    break;
                case "CANCELLED":
                    $statusPl = "ZLECENIA: ANULOWANE";
                    break;
                case "IN_PROGRESS":
                    $statusPl = "ZLECENIA: TRAKCIE REALIZACJI";
                    break;
                case "RETURNED":
                    $statusPl = "ZLECENIA: ZWRÓCONE, DO FAKTUROWANIA";
                    break;
                case "ENDED":
                    $statusPl = "ZLECENIA: ZAKOŃCZONE";
                    break;
                case "ARCHIVED":
                    $statusPl = "ZLECENIA: ZARCHIWIZOWANE";
                    break;
            }

            $msg = $statusPl;
        }
        else
        {
            $orders = $this->service->getOrdersByStatus();
            $counter = $this->service->getOrdersNumberByStatus();
            $msg = "ZLECENIA: WSZYSTKIE";
        }

        return $this->render("admin/view/order/getOrdersView.html.twig", [
            "orders" => $orders,
            "counter" => $counter,
            "msg" => $msg
        ]);
    }

    #[Route("/{id}", name: "app_view_admin_orders_get-order-details-view", methods: ['GET'])]
    public function ordersGetOrderDetailsView(int $id): Response
    {
        $order = $this->service->getOrderById($id);

        return $this->render('admin/view/order/orderDetails.html.twig', [
            "id" => $order->getId(),
            "status" => $order->getStatus(),
            "clientsData"=> $order->getClientsData(),
			"principal" => $order->getPrincipal(),
			"internalCaseNumber" => $order->getInternalCaseNumber(),
			"externalCaseNumber" => $order->getExternalCaseNumber(),
			"proposedSegment" => $order->getProposedSegment(),
			"deliveryAddress" => $order->getDeliveryAddress(),
			"deliveryDatetime" => $order->getDeliveryDatetime()->format('d/m/Y, H:i:s'),
			"deliveryComments" => $order->getDeliveryComments(),
			"deliveryBranch" => $order->getDeliveryBranch(),
			"returnedAddress" => $order->getReturnedAddress(),
			"returnedDatetime" => $order->getReturnedDatetime()->format('d/m/Y, H:i:s'),
			"returnedComments" => $order->getReturnedComments(),
			"returnedBranch" => $order->getReturnedBranch(),
			"reasonForCancellingTheOrder" => $order->getReasonForCancellingTheOrder()
        ]);
    }

    #[Route('/{id}/edit', name: 'app_view_admin_orders_edit-order-by-id', methods: ['GET', 'POST'])]
    public function editOrderById(int $id, Request $request): Response
    {
        $order = $this->service->getOrderById($id);

        $form = $this->createForm(OrderType::class, $order, [

        ]);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $order = $form->getData();

            $this->service->createNewOrder($order);

            return $this->redirectToRoute('app_view_admin_orders_get-orders-view');
        }

        return $this->render('admin/view/order/editOrder.html.twig', [
            "id" => $order->getId(),
            "form" => $form->createView()
        ]);
    }

    #[Route("/{id}/remove", name: "app_view_admin_orders_remove-order-by-id", methods: ['GET'])]
    public function removeOrderById(int $id): Response
    {
        $this->service->deleteOrderById($id);
        return $this->redirect('/panel-administratora/orders');
    }

}