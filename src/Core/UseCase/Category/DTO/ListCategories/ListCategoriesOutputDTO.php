<?php

namespace Core\UseCase\Category\DTO\ListCategories;

class ListCategoriesOutputDTO
{
  public function __construct(
    public int $total,
    public array $items
  ) {
  }
}
