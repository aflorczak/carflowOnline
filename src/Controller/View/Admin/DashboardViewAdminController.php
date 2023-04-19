<?php

namespace App\Controller\View\Admin;

use App\Service\CarService;
use App\Service\OrderService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route("/panel-administratora")]
class DashboardViewAdminController extends AbstractController
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

    #[Route("", name: "app_view_admin_dashboard_get-index", methods: ['GET'])]
    public function dashboardGetIndexView():Response
    {
        $allCars = $this->carService->getCarsNumberByStatus();
        $activeCars = $this->carService->getCarsNumberByStatus('ACTIVE');
        $blockedCars = $this->carService->getCarsNumberByStatus('BLOCKED');
        $archivedCars = $this->carService->getCarsNumberByStatus('ARCHIVED');

        $allOrders = $this->orderService->getOrdersNumberByStatus();
        $newOrders = $this->orderService->getOrdersNumberByStatus('NEW');
        $inProgressOrders = $this->orderService->getOrdersNumberByStatus('IN_PROGRESS');
        $returnedOrders = $this->orderService->getOrdersNumberByStatus('RETURNED');
        $endedOrders = $this->orderService->getOrdersNumberByStatus('ENDED');
        $cancelledOrders = $this->orderService->getOrdersNumberByStatus('CANCELLED');

        return $this->render("admin/view/dashboard/index.html.twig", [
            "allCars" => $allCars,
            "activeCars" => $activeCars,
            "blockedCars" => $blockedCars,
            "archivedCars" => $archivedCars,
            "allOrders" => $allOrders,
            "newOrders" => $newOrders,
            "inProgressOrders" => $inProgressOrders,
            "returnedOrders" => $returnedOrders,
            "endedOrders" => $endedOrders,
            "cancelledOrders" => $cancelledOrders
        ]);
    }

}