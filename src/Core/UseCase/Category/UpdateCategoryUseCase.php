<?php

namespace Core\UseCase\Category;

use Core\Domain\Repository\ICategoryRepository;
use Core\UseCase\Category\DTO\UpdateCategory\UpdateCategoryInputDTO;
use Core\UseCase\Category\DTO\UpdateCategory\UpdateCategoryOutputDTO;
use Hamcrest\Description;

class UpdateCategoryUseCase
{
  public function __construct(
    protected ICategoryRepository $repository
  ) {
  }

  public function execute(UpdateCategoryInputDTO $input): UpdateCategoryOutputDTO
  {
    $category = $this->repository->findById($input->id);

    $category->update(
      name: $input->name,
      description: $input->description ?? $category->description
    );

    $updatedCategory = $this->repository->update($category);

    return new UpdateCategoryOutputDTO(
      id: $updatedCategory->id,
      name: $updatedCategory->name,
      description: $updatedCategory->description,
      isActive: $updatedCategory->isActive,
    );
  }
}
