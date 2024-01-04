<?php

namespace Tests\Unit\UseCase\Category;

use Core\Domain\Entity\Category;
use Core\Domain\Repository\ICategoryRepository;
use Mockery;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;
use stdClass;

class ListCategoryUseCaseUnitTest extends TestCase
{
  public function test_get_by_id(): void
  {
    $uuid = (string) Uuid::uuid4()->toString();
    $categoryName = 'New Category';

    $mockEntity = Mockery::mock(Category::class, [$uuid, $categoryName]);

    $mockRepo = Mockery::mock(stdClass::class, ICategoryRepository::class);
    $mockRepo->shouldReceive('findById')->with($uuid)->andReturn($mockEntity);

    $mockInputDto = Mockery::mock(CategoryInputDto::class, [$uuid]);

    $useCase = new ListCategoryUseCase($mockRepo);
    $response = $useCase->execute($mockInputDto);

    $this->assertInstanceOf(CategoryOutputDto::class, $response);
    $this->assertEquals($categoryName, $response->name);
    $this->assertEquals($uuid, $response->id);
  }
}
