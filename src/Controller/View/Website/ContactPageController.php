<?php

namespace App\Controller\View\Website;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/contact')]
class ContactPageController extends AbstractController
{
    #[Route('/', name: 'app_view_website_get-contact-page-view', methods: ['GET'])]
    public function getContactPage(): Response
    {
        return $this->render('website/view/contactPage.html.twig', [
            "title" => "Kontakt"
        ]);
    }
}