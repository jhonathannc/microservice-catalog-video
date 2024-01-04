<?php

namespace Tests\Unit\UseCase\Category;

use Core\Domain\Entity\Category;
use Core\Domain\Repository\ICategoryRepository;
use Core\UseCase\Category\CreateCategoryUseCase;
use Mockery;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;
use stdClass;

class CreateCategoryUseCaseUnitTest extends TestCase
{
  public function test_create_new_category(): void
  {
    $categoryId = Uuid::uuid4()->toString();
    $categoryName = 'New category';

    // $mockEntity = Mockery::mock(Category::class, [$categoryId, $categoryName]);

    $mockRepo = Mockery::mock(stdClass::class, ICategoryRepository::class);
    $mockRepo->shouldReceive('insert'); //->andReturn($mockEntity);

    $useCase = new CreateCategoryUseCase($mockRepo);
    $useCase->execute();

    $this->assertTrue(true);

    Mockery::close();
  }
}
