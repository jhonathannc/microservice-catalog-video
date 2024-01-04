<?php

namespace Tests\Unit\UseCase\Category;

use Core\Domain\Entity\Category as CategoryEntity;
use Core\Domain\Repository\ICategoryRepository;
use Core\UseCase\Category\DTO\UpdateCategory\UpdateCategoryInputDTO;
use Core\UseCase\Category\DTO\UpdateCategory\UpdateCategoryOutputDTO;
use Core\UseCase\Category\UpdateCategoryUseCase;
use Mockery;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;
use stdClass;

class UpdateCategoryUseCaseUnitTest extends TestCase
{
  public function test_rename_category(): void
  {
    $id = Uuid::uuid4()->toString();
    $name = 'some name';
    $description = 'some desc';

    $mockEntity = Mockery::mock(CategoryEntity::class, [$id, $name, $description]);
    $mockEntity->shouldReceive('update');

    $mockRepo = Mockery::mock(stdClass::class, ICategoryRepository::class);
    $mockRepo->shouldReceive('findById')->andReturn($mockEntity);
    $mockRepo->shouldReceive('update')->andReturn($mockEntity);

    $mockInputDto = Mockery::mock(UpdateCategoryInputDTO::class, [$id, 'new name']);

    $useCase = new UpdateCategoryUseCase($mockRepo);
    $response = $useCase->execute($mockInputDto);

    $this->assertInstanceOf(UpdateCategoryOutputDTO::class, $response);

    // Spies
    $spyRepo = Mockery::mock(stdClass::class, ICategoryRepository::class);
    $spyRepo->shouldReceive('findById')->andReturn($mockEntity);
    $spyRepo->shouldReceive('update')->andReturn($mockEntity);

    $useCase = new UpdateCategoryUseCase($spyRepo);
    $useCase->execute($mockInputDto);

    $spyRepo->shouldHaveReceived('findById');
    $spyRepo->shouldHaveReceived('update');
  }


  public function tearDown(): void
  {
    Mockery::close();

    parent::tearDown();
  }
}
