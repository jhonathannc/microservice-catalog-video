<?php

namespace Tests\Unit\UseCase\Category;

use Core\Domain\Entity\Category;
use Core\Domain\Repository\ICategoryRepository;
use Core\UseCase\Category\CreateCategoryUseCase;
use Core\UseCase\Category\DTO\CategoryCreateInputDTO;
use Core\UseCase\Category\DTO\CategoryCreateOutputDTO;
use Mockery;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;
use stdClass;

class CreateCategoryUseCaseUnitTest extends TestCase
{
  public function test_create_new_category(): void
  {
    $uuid = (string) Uuid::uuid4()->toString();
    $categoryName = 'New category';

    $mockEntity = Mockery::mock(Category::class, [$uuid, $categoryName]);
    $mockEntity->shouldReceive('id')->andReturn($uuid);

    $mockRepo = Mockery::mock(stdClass::class, ICategoryRepository::class);
    $mockRepo->shouldReceive('insert')->andReturn($mockEntity);

    $mockInputDTO = Mockery::mock(CategoryCreateInputDTO::class, [$categoryName]);

    $useCase = new CreateCategoryUseCase($mockRepo);
    $responseUseCase = $useCase->execute($mockInputDTO);

    $this->assertInstanceOf(CategoryCreateOutputDTO::class, $responseUseCase);
    $this->assertEquals($categoryName, $responseUseCase->name);
    $this->assertEquals('', $responseUseCase->description);

    Mockery::close();
  }

  public function test_create_new_category_spies(): void
  {
    $uuid = (string) Uuid::uuid4()->toString();
    $categoryName = 'New category';

    $mockEntity = Mockery::mock(Category::class, [$uuid, $categoryName]);
    $mockEntity->shouldReceive('id')->andReturn($uuid);

    $spyRepo = Mockery::spy(stdClass::class, ICategoryRepository::class);
    $spyRepo->shouldReceive('insert')->andReturn($mockEntity);

    $mockInputDTO = Mockery::mock(CategoryCreateInputDTO::class, [$categoryName]);

    $useCase = new CreateCategoryUseCase($spyRepo);
    $useCase->execute($mockInputDTO);

    $spyRepo->shouldHaveReceived('insert'); // will handle and error if insert method wasn't called

    $this->assertTrue(true); // just assert an test to fix warn message
  }

  public function tearDown(): void
  {
    Mockery::close();

    parent::tearDown();
  }
}
