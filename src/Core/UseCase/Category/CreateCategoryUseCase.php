<?php

namespace Core\UseCase\Category;

use Core\Domain\Entity\Category;
use Core\Domain\Repository\ICategoryRepository;
use Core\UseCase\Category\DTO\CategoryCreateInputDTO;

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
      name: 'FooBar'
    );

    $this->repository->insert($category);
  }
}
