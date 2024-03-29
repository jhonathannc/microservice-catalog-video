<?php

namespace Tests\Unit\UseCase\Category;

use Core\Domain\Entity\Category;
use Core\Domain\Repository\ICategoryRepository;
use Core\UseCase\Category\DTO\CategoryInputDTO;
use Core\UseCase\Category\DTO\CategoryOutputDTO;
use Core\UseCase\Category\ListCategoryUseCase;
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
    $mockEntity->shouldReceive('id')->andReturn($uuid);
    $mockEntity->shouldReceive('createdAt')->andReturn(date('Y-m-d H:i:s'));

    $mockRepo = Mockery::mock(stdClass::class, ICategoryRepository::class);
    $mockRepo->shouldReceive('findById')->with($uuid)->andReturn($mockEntity);

    $mockInputDto = Mockery::mock(CategoryInputDTO::class, [$uuid]);

    $useCase = new ListCategoryUseCase($mockRepo);
    $response = $useCase->execute($mockInputDto);

    $this->assertInstanceOf(CategoryOutputDTO::class, $response);
    $this->assertEquals($categoryName, $response->name);
    $this->assertEquals($uuid, $response->id);
  }

  public function test_get_by_id_spies(): void
  {
    $uuid = (string) Uuid::uuid4()->toString();
    $categoryName = 'New Category';

    $mockEntity = Mockery::mock(Category::class, [$uuid, $categoryName]);
    $mockEntity->shouldReceive('id')->andReturn($uuid);
    $mockEntity->shouldReceive('createdAt')->andReturn(date('Y-m-d H:i:s'));

    $spyRepo = Mockery::mock(stdClass::class, ICategoryRepository::class);
    $spyRepo->shouldReceive('findById')->with($uuid)->andReturn($mockEntity);

    $mockInputDto = Mockery::mock(CategoryInputDTO::class, [$uuid]);

    $useCase = new ListCategoryUseCase($spyRepo);
    $useCase->execute($mockInputDto);

    $spyRepo->shouldHaveReceived('findById');

    $this->assertTrue(true);
  }

  protected function tearDown(): void
  {
    Mockery::close();

    parent::tearDown();
  }
}
