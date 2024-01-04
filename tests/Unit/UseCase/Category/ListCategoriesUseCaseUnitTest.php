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
    $mockPaginate = $this->mockPagination();

    $mockRepo = Mockery::mock(stdClass::class, ICategoryRepository::class);
    $mockRepo->shouldReceive('paginate')->andReturn($mockPaginate);

    $mockInputDto = Mockery::mock(ListCategoriesInputDTO::class, ['filter', 'desc']);

    $useCase = new ListCategoriesUseCase($mockRepo);
    $response = $useCase->execute($mockInputDto);

    $this->assertCount(0, $response->items);
    $this->assertInstanceOf(ListCategoriesOutputDTO::class, $response);

    //spies
    $spyRepo = Mockery::mock(stdClass::class, ICategoryRepository::class);
    $spyRepo->shouldReceive('paginate')->andReturn($mockPaginate);
    $useCase = new ListCategoriesUseCase($spyRepo);
    $useCase->execute($mockInputDto);

    $spyRepo->shouldHaveReceived('paginate');
  }

  protected function mockPagination()
  {
    $mockPaginate = Mockery::mock(stdClass::class, IPagination::class);
    $mockPaginate->shouldReceive('items')->andReturn([]);
    $mockPaginate->shouldReceive('total')->andReturn(0);
    $mockPaginate->shouldReceive('lastPage')->andReturn(0);
    $mockPaginate->shouldReceive('firstPage')->andReturn(0);
    $mockPaginate->shouldReceive('perPage')->andReturn(0);
    $mockPaginate->shouldReceive('to')->andReturn(0);
    $mockPaginate->shouldReceive('from')->andReturn(0);
    $mockPaginate->shouldReceive('currentPage')->andReturn(0);

    return $mockPaginate;
  }

  protected function tearDown(): void
  {
    Mockery::close();

    parent::tearDown();
  }
}
