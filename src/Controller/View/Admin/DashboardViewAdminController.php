<?php

namespace App\Controller\View\Admin;

use App\Service\CarService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route("/admin")]
class DashboardViewAdminController extends AbstractController
{
    private CarService $service;

    public function __construct(CarService $service)
    {
        $this->service = $service;
    }

    #[Route("", name: "app_view_admin_dashboard_get-index", methods: ['GET'])]
    public function dashboardGetIndexView():Response
    {
        $allCars = $this->service->getCarsNumberByStatus();
        $activeCars = $this->service->getCarsNumberByStatus('ACTIVE');
        $blockedCars = $this->service->getCarsNumberByStatus('BLOCKED');
        $archivedCars = $this->service->getCarsNumberByStatus('ARCHIVED');

        return $this->render("admin/view/dashboard/index.html.twig", [
            "allCars" => $allCars,
            "activeCars" => $activeCars,
            "blockedCars" => $blockedCars,
            "archivedCars" => $archivedCars
        ]);
    }

}