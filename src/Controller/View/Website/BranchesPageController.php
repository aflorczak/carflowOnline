<?php

namespace App\Controller\View\Website;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/oddzialy')]
class BranchesPageController extends AbstractController
{
    #[Route('/', name: 'app_view_website_get-branches-page-view', methods: ['GET'])]
    public function getBranchesPage(): Response
    {
        return $this->render('website/view/branchesPage.html.twig', [
            "title" => "Oddziały"
        ]);
    }
}