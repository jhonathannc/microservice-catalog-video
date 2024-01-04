<?php

namespace Core\UseCase\Category\DTO\ListCategories;

class ListCategoriesOutputDTO
{
  public function __construct(
    public int $total,
    public array $items,
    public int $lastPage,
    public int $firstPage,
    public int $perPage,
    public int $to,
    public int $from,
    public int $currentPage,
  ) {
  }
}
