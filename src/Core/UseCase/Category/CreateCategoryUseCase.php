<?php

namespace Core\UseCase\Category;

use Core\Domain\Entity\Category;
use Core\Domain\Repository\ICategoryRepository;
use Core\UseCase\Category\DTO\CategoryCreateInputDTO;
use Core\UseCase\Category\DTO\CategoryCreateOutputDTO;

class CreateCategoryUseCase
{
  protected $repository;

  public function __construct(ICategoryRepository $repository)
  {
    $this->repository = $repository;
  }

  public function execute(CategoryCreateInputDTO $input)
  {
    $category = new Category(
      name: $input->name,
      description: $input->description,
      isActive: $input->isActive
    );

    $newCategory = $this->repository->insert($category);

    return new CategoryCreateOutputDTO(
      id: $newCategory->id(),
      name: $newCategory->name,
      description: $newCategory->description,
      isActive: $newCategory->isActive,
    );
  }
}
