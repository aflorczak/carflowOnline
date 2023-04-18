<?php

namespace App\Controller\View\Admin;

use App\Service\OrderService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route("/admin/orders")]
class OrderViewAdminController extends AbstractController
{
    private OrderService $service;

    public function __construct(OrderService $service)
    {
        $this->service = $service;
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
                    $statusPl = "NOWE ZLECENIA";
                    break;
                case "CANCELLED":
                    $statusPl = "ANULOWANE ZLECENIA";
                    break;
                case "IN_PROGRESS":
                    $statusPl = "ZLECENIA W TRAKCIE REALIZACJI";
                    break;
                case "RETURNED":
                    $statusPl = "ZLECENIA PRZEZNACZONE DO FAKTUROWANIA";
                    break;
                case "ENDED":
                    $statusPl = "ZAKOŃCZONE ZLECENIA";
                    break;
                case "ARCHIVED":
                    $statusPl = "ZARCHIWIZOWANE ZLECENIA";
                    break;
            }

            $msg = "Zakres: " . $statusPl;
        }
        else
        {
            $orders = $this->service->getOrdersByStatus();
            $counter = $this->service->getOrdersNumberByStatus();
            $msg = "Zakres: WSZYSTKIE ZLECENIA";
        }

        return $this->render("admin/view/order/getOrdersView.html.twig", [
            "orders" => $orders,
            "counter" => $counter,
            "msg" => $msg
        ]);
    }

}