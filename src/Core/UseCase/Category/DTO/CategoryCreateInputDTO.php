<?php

namespace Core\UseCase\Category\DTO;

class CategoryCreateInputDTO
{
  public function __construct(
    public string $name,
    public string $description = '',
    public bool $isActive = true
  ) {
  }
}
