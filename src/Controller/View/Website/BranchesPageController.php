<?php

namespace App\Controller\View\Website;

use App\Service\BranchService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/oddzialy')]
class BranchesPageController extends AbstractController
{
    private BranchService $service;

    public function __construct(BranchService $service)
    {
        $this->service = $service;
    }

    #[Route('/', name: 'app_view_website_get-branches-page-view', methods: ['GET'])]
    public function getBranchesPage(): Response
    {
        $branches = $this->service->getAllBranches();

        return $this->render('website/view/branchesPage.html.twig', [
            "title" => "Oddziały",
            "branches" => $branches
        ]);
    }
}