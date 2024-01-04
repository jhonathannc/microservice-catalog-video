<?php

namespace Core\UseCase\Category;

use Core\Domain\Repository\ICategoryRepository;
use Core\UseCase\Category\DTO\ListCategories\ListCategoriesInputDTO;
use Core\UseCase\Category\DTO\ListCategories\ListCategoriesOutputDTO;

class ListCategoriesUseCase
{
  public function __construct(
    protected ICategoryRepository $repository
  ) {
  }

  public function execute(ListCategoriesInputDTO $input): ListCategoriesOutputDTO
  {
    $categories = $this->repository->paginate(
      filter: $input->filter,
      order: $input->order,
      page: $input->page,
      perPage: $input->perPage,
    );

    return new ListCategoriesOutputDTO(
      total: $categories->total(),
      items: $categories->items()
    );
  }
}
