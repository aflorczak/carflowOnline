<?php

namespace App\Service;

use App\Entity\Branch;
use App\Repository\BranchRepository;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class BranchService
{
    private BranchRepository $repository;

    public function __construct(BranchRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getBranchesNumber(): int
    {
        return $this->repository->count([]);
    }

    public function createNewBranch(Branch $branch): Branch
    {
        return $this->repository->save($branch, true);
    }

    public function getAllBranches(): array
    {
        return $this->repository->findAll();
    }

    public function getBranchById(int $id): Branch
    {
        $branch = $this->repository->findOneBy(["id" => $id]);

        if ($branch)
        {
            return $branch;
        }
        else
        {
            throw new NotFoundHttpException("Not Found.");
        }
    }

    public function getBranchBySlug(string $slug): Branch
    {
        $branch = $this->repository->findOneBy(["slug" => $slug]);

        if ($branch)
        {
            return $branch;
        }
        else
        {
            throw new NotFoundHttpException("Not Found.");
        }
    }

    public function updateBranchById(Branch $branch): Branch
    {
        $id = $branch->getId();

        $updatedBranch = $this->repository->findOneBy(["id" => $id]);

        if ($updatedBranch)
        {
            $updatedBranch->setName($branch->getName());
            $updatedBranch->setSlug($branch->getSlug());
            $updatedBranch->setAddressFirstLine($branch->getAddressFirstLine());
            $updatedBranch->setAddressSecondLine($branch->getAddressSecondLine());
            $updatedBranch->setPostCode($branch->getPostCode());
            $updatedBranch->setCity($branch->getCity());
            $updatedBranch->setImgSrc($branch->getImgSrc());
            $updatedBranch->setNavLink($branch->getNavLink());
            $updatedBranch->setMapLink($branch->getMapLink());
            $updatedBranch->setEmail($branch->getEmail());
            $updatedBranch->setPhone($branch->getPhone());

            return $this->repository->save($updatedBranch, true);
        }
        else
        {
            throw new NotFoundHttpException("Not Found.");
        }
    }

    public function deleteBranchById(int $id): void
    {
        $branch = $this->repository->findOneBy(["id" => $id]);

        if ($branch)
        {
            $this->repository->remove($branch, true);
        }
        else
        {
            throw new NotFoundHttpException("Not Found.");
        }
    }
}