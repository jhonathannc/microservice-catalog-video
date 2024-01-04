<?php

namespace Tests\Unit\UseCase\Category;

use Core\Domain\Repository\ICategoryRepository;
use Core\Domain\Repository\IPagination;
use Core\UseCase\Category\DTO\ListCategories\ListCategoriesInputDTO;
use Core\UseCase\Category\DTO\ListCategories\ListCategoriesOutputDTO;
use Core\UseCase\Category\ListCategoriesUseCase;
use Mockery;
use PHPUnit\Framework\TestCase;
use stdClass;

class ListCategoriesUseCaseUnitTest extends TestCase
{
  public function test_list_categories_empty(): void
  {
    $mockPaginate = Mockery::mock(stdClass::class, IPagination::class);
    $mockPaginate->shouldReceive('items')->andReturn([]);
    $mockPaginate->shouldReceive('total')->andReturn(0);

    $mockRepo = Mockery::mock(stdClass::class, ICategoryRepository::class);
    $mockRepo->shouldReceive('paginate')->andReturn($mockPaginate);

    $mockInputDto = Mockery::mock(ListCategoriesInputDTO::class, ['filter', 'desc']);

    $useCase = new ListCategoriesUseCase($mockRepo);
    $response = $useCase->execute($mockInputDto);

    $this->assertCount(0, $response->items);
    $this->assertInstanceOf(ListCategoriesOutputDTO::class, $response);
  }

  protected function tearDown(): void
  {
    Mockery::close();

    parent::tearDown();
  }
}