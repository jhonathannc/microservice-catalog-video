<?php

namespace Tests\Unit\Domain\Entity;

use Core\Domain\Entity\Category;
use Core\Domain\Exception\EntityValidationException;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;
use Throwable;

class CategoryUnitTest extends TestCase
{
  public function test_attributes(): void
  {
    $category = new Category(
      name: 'New Category',
      description: 'Description',
      isActive: true,
    );

    $this->assertNotEmpty($category->createdAt());
    $this->assertNotEmpty($category->id());
    $this->assertEquals('New Category', $category->name);
    $this->assertEquals('Description', $category->description);
    $this->assertTrue($category->isActive);
  }

  public function test_activated(): void
  {
    $category = new Category(
      name: 'New Category',
      isActive: false
    );

    $this->assertFalse($category->isActive);
    $category->activate();
    $this->assertTrue($category->isActive);
  }

  public function test_disabled(): void
  {
    $category = new Category(
      name: 'New Category',
    );

    $this->assertTrue($category->isActive);
    $category->disable();
    $this->assertFalse($category->isActive);
  }

  public function test_update(): void
  {
    $uuid = (string) Uuid::uuid4()->toString();

    $category = new Category(
      id: $uuid,
      name: 'New Category',
      description: 'Description',
      isActive: true,
      createdAt: '2023-01-01 12:12:12'
    );

    $category->update(
      name: 'new_name',
      description: 'new_description',
    );

    $this->assertEquals($uuid, $category->id());
    $this->assertEquals('new_name', $category->name);
    $this->assertEquals('new_description', $category->description);
  }

  public function test_exception_name(): void
  {
    try {
      new Category(
        name: 'N', // Need to handle an exception
        description: 'Description',
      );

      $this->assertTrue(false);
    } catch (Throwable $err) {
      $this->assertInstanceOf(EntityValidationException::class, $err);
    }
  }

  public function test_exception_description(): void
  {
    try {
      new Category(
        name: 'New category',
        description: random_bytes(256), // Need to handle an exception
      );

      $this->assertTrue(false);
    } catch (Throwable $err) {
      $this->assertInstanceOf(EntityValidationException::class, $err);
    }
  }
}
