<?php

namespace Core\UseCase\Category;

use Core\Domain\Repository\ICategoryRepository;
use Core\UseCase\Category\DTO\CategoryInputDTO;
use Core\UseCase\Category\DTO\DeleteCategory\DeleteCategoryOutputDTO;

class DeleteCategoryUseCase
{
  public function __construct(
    protected ICategoryRepository $repository
  ) {
  }

  public function execute(CategoryInputDTO $input): DeleteCategoryOutputDTO
  {
    $response = $this->repository->delete($input->id);

    return new DeleteCategoryOutputDTO(success: $response);
  }
}
