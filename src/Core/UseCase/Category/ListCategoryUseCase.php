<?php

namespace Core\UseCase\Category;

use Core\Domain\Repository\ICategoryRepository;
use Core\UseCase\Category\DTO\CategoryInputDTO;
use Core\UseCase\Category\DTO\CategoryOutputDTO;

class ListCategoryUseCase
{
  public function __construct(
    protected ICategoryRepository $repository
  ) {
  }

  public function execute(CategoryInputDTO $input): CategoryOutputDTO
  {
    $category = $this->repository->findById($input->id);

    return new CategoryOutputDTO(
      id: $category->id(),
      name: $category->name,
      description: $category->description,
      isActive: $category->isActive,
      created_at: $category->createdAt()
    );
  }
}
