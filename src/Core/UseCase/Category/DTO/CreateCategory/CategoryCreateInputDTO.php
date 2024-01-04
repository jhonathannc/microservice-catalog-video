<?php

namespace Core\UseCase\Category\DTO\CreateCategory;

class CategoryCreateInputDTO
{
  public function __construct(
    public string $name,
    public string $description = '',
    public bool $isActive = true
  ) {
  }
}
