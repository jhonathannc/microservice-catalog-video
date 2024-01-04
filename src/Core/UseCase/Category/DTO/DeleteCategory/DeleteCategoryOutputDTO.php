<?php

namespace Core\UseCase\Category\DTO\DeleteCategory;

class DeleteCategoryOutputDTO
{
  public function __construct(
    public bool $success
  ) {
  }
}
