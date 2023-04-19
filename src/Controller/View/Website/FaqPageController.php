<?php

namespace App\Controller\View\Website;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/faq')]
class FaqPageController extends AbstractController
{
    #[Route('/', name: 'app_view_website_get-faq-page-view', methods: ['GET'])]
    public function getFaqPage(): Response
    {
        return $this->render('website/view/faqPage.html.twig', [
            "title" => "FAQ"
        ]);
    }
}