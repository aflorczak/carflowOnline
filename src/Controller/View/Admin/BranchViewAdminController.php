<?php

namespace App\Controller\View\Admin;

use App\Entity\Branch;
use App\Form\Branch\BranchType;
use App\Service\BranchService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route("/panel-administratora/branches")]
class BranchViewAdminController extends AbstractController
{
    private BranchService $service;

    public function __construct(BranchService $service)
    {
        $this->service = $service;
    }

    #[Route("/new", name: "app_view_admin_branches_new-branches-view", methods: ['GET', 'POST'])]
    public function newBranchesView(Request $request): Response
    {
        $branch = new Branch();

        $form = $this->createForm(BranchType::class, $branch);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $branch = $form->getData();

            $this->service->createNewBranch($branch);

            return $this->redirectToRoute('app_view_admin_branches_get-branches-view');
        }

        return $this->render('admin/view/branch/newBranch.html.twig', [
            "form" => $form->createView()
        ]);
    }

    #[Route("", name: "app_view_admin_branches_get-branches-view", methods: ['GET'])]
    public function branchesGetBranchesView(Request $request): Response
    {
        $branches = $this->service->getAllBranches();
        $counter = $this->service->getBranchesNumber();

        return $this->render("admin/view/branch/getBranchesView.html.twig", [
            "branches" => $branches,
            "counter" => $counter
        ]);
    }

    #[Route("/{id}", name: "app_view_admin_branches_get-branch-details-view", methods: ['GET'])]
    public function branchesGetBranchDetailsView(int $id): Response
    {
        $branch = $this->service->getBranchById($id);

        return $this->render('admin/view/branch/branchDetails.html.twig', [
            "branch" => $branch
        ]);
    }

    #[Route('/{id}/edit', name: 'app_view_admin_branches_edit-branch-by-id', methods: ['GET', 'POST'])]
    public function editBranchById(int $id, Request $request): Response
    {
        $branch = $this->service->getBranchById($id);

        $form = $this->createForm(BranchType::class, $branch);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $branch = $form->getData();

            $this->service->createNewBranch($branch);

            return $this->redirectToRoute('app_view_admin_branches_get-branches-view');
        }

        return $this->render('admin/view/branch/editBranch.html.twig', [
            "id" => $branch->getId(),
            "form" => $form->createView()
        ]);
    }

    #[Route("/{id}/remove", name: "app_view_admin_branches_remove-branch-by-id", methods: ['GET'])]
    public function removeBranchById(int $id): Response
    {
        $this->service->deleteBranchById($id);
        return $this->redirect('/panel-administratora/branches');
    }

}