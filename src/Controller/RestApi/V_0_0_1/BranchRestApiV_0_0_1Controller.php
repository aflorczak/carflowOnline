<?php

namespace App\Controller\RestApi\V_0_0_1;

use App\Entity\Branch;
use App\Service\BranchService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route("/api/v-0_0_1/branches")]
class BranchRestApiV_0_0_1Controller extends AbstractController
{
    private BranchService $service;

    public function __construct(BranchService $service)
    {
        $this->service = $service;
    }

    #[Route("", name: "app_rest-api_v-0-0-1_branches_create-branch", methods: ['POST'])]
    public function createNewBranch(Request $request): Response
    {
        $data = json_decode($request->getContent(), true);

        $name = $data['name'];
        $slug = $data['slug'];
        $addressFirstLine = $data['addressFirstLine'];
        $addressSecondLine = $data['addressSecondLine'];
        $postCode = $data['postCode'];
        $city = $data['city'];
        $navLink = $data['navLink'];
        $mapLink = $data['mapLink'];
        $imgSrc = $data['imgSrc'];
        $email = $data['email'];
        $phone = $data['phone'];
        $cars = array();

        // tutaj miejsce na funkcje walidacji
        // sprawdzić czy nie istnieje już oddział o podanym slug, jak tak to zablokować operacje

        $newBranch = new Branch();
        $newBranch->setName($name);
        $newBranch->setSlug($slug);
        $newBranch->setAddressFirstLine($addressFirstLine);
        $newBranch->setAddressSecondLine($addressSecondLine);
        $newBranch->setPostCode($postCode);
        $newBranch->setCity($city);
        $newBranch->setCars($cars);
        $newBranch->setNavLink($navLink);
        $newBranch->setMapLink($mapLink);
        $newBranch->setImgSrc($imgSrc);
        $newBranch->setEmail($email);
        $newBranch->setPhone($phone);

        $addedBranch = $this->service->createNewBranch($newBranch);

        return $this->json([
            "data" => [
                "branch" => $addedBranch
            ]
        ], 201);
    }

    #[Route("", name: "app_rest-api_v-0-0-1_branches_get-branches", methods: ['GET'])]
    public function getBranches(): Response
    {
        $branches = $this->service->getAllBranches();

        return $this->json([
            "data" => [
                "branches" => $branches
            ]
        ], 200);
    }

    #[Route("/{slug}", name: "app_rest-api_v-0-0-1_branches_get-branch-by-slug", methods: ['GET'])]
    public function getBranchBySlug(string $slug): Response
    {
        $branch = $this->service->getBranchBySlug($slug);

        return $this->json([
            "data" => [
                "branch" => $branch
            ]
        ], 200);
    }

    #[Route("/{id}", name: "app_rest-api_v-0-0-1_branches_update-branch-by-id", methods: ['PUT'])]
    public function updateBranchById(int $id, Request $request): Response
    {
        $data = json_decode($request->getContent(), true);

        $name = $data['name'];
        $slug = $data['slug'];
        $addressFirstLine = $data['addressFirstLine'];
        $addressSecondLine = $data['addressSecondLine'];
        $postCode = $data['postCode'];
        $city = $data['city'];
        $navLink = $data['navLink'];
        $mapLink = $data['mapLink'];
        $imgSrc = $data['imgSrc'];
        $email = $data['email'];
        $phone = $data['phone'];

        // tutaj miejsce na funkcje walidacji
        // sprawdzić czy nie istnieje już oddział o podanym slug, jak tak to zablokować operacje

        $updateBranch = new Branch();
        $updateBranch->setId($id);
        $updateBranch->setName($name);
        $updateBranch->setSlug($slug);
        $updateBranch->setAddressFirstLine($addressFirstLine);
        $updateBranch->setAddressSecondLine($addressSecondLine);
        $updateBranch->setPostCode($postCode);
        $updateBranch->setCity($city);
        $updateBranch->setNavLink($navLink);
        $updateBranch->setMapLink($mapLink);
        $updateBranch->setImgSrc($imgSrc);
        $updateBranch->setEmail($email);
        $updateBranch->setPhone($phone);

        $updatedBranch = $this->service->updateBranchById($updateBranch);

        return $this->json([
            "data" => [
                "branch" => $updatedBranch
            ]
        ], 202);
    }

    #[Route("/{id}", name: "app_rest-api_v-0-0-1_branches_delete-branch-by-id", methods: ['DELETE'])]
    public function deleteBranchById(int $id): Response
    {
        $this->service->deleteBranchById($id);

        return $this->json([], 204);
    }
}