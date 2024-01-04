<?php

namespace Tests\Unit\UseCase\Category;

use Core\Domain\Entity\Category;
use Core\Domain\Repository\ICategoryRepository;
use Core\UseCase\Category\DeleteCategoryUseCase;
use Core\UseCase\Category\DTO\CategoryInputDTO;
use Core\UseCase\Category\DTO\DeleteCategory\DeleteCategoryOutputDTO;
use Mockery;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;
use stdClass;

class DeleteCategoryUseCaseUnitTest extends TestCase
{
  public function test_delete(): void
  {
    $id = (string) Uuid::uuid4()->toString();

    $mockRepo = Mockery::mock(stdClass::class, ICategoryRepository::class);
    $mockRepo->shouldReceive('delete')->andReturn(true);

    $mockInputDto = Mockery::mock(CategoryInputDTO::class, [$id]);

    $useCase = new DeleteCategoryUseCase($mockRepo);
    $response = $useCase->execute($mockInputDto);

    $this->assertInstanceOf(DeleteCategoryOutputDTO::class, $response);
    $this->assertTrue($response->success);

    // Spies
    $spyRepo = Mockery::mock(stdClass::class, ICategoryRepository::class);
    $spyRepo->shouldReceive('delete')->andReturn(true);

    $useCase = new DeleteCategoryUseCase($spyRepo);
    $useCase->execute($mockInputDto);

    $spyRepo->shouldHaveReceived('delete');
  }

  public function tearDown(): void
  {
    Mockery::close();

    parent::tearDown();
  }
}
