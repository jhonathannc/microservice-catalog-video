<?php

namespace Core\UseCase\Category;

use Core\Domain\Entity\Category;
use Core\Domain\Repository\ICategoryRepository;
use Core\UseCase\Category\DTO\CreateCategory\CategoryCreateInputDTO;
use Core\UseCase\Category\DTO\CreateCategory\CategoryCreateOutputDTO;

class CreateCategoryUseCase
{
  protected $repository;

  public function __construct(ICategoryRepository $repository)
  {
    $this->repository = $repository;
  }

  public function execute(CategoryCreateInputDTO $input): CategoryCreateOutputDTO
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
      created_at: $newCategory->createdAt()
    );
  }
}
