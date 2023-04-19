<?php

namespace App\Controller\View\Website;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/strony')]
class PagesPageController extends AbstractController
{

    #[Route('/{slug}', name: 'app_view_website_get-pages-by-slug-page-view', methods: ['GET'])]
    public function getPagesBySlugPage(string $slug): Response
    {
        // get page by slug from pagesService (db)

        return $this->render('website/view/pagesBySlugPage.html.twig', [
            "title" => "Tytuł",
            "content" => "Treść"
        ]);
    }
}