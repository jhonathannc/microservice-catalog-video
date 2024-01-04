<?php

namespace Tests\Unit\Domain\Validation;

use Core\Domain\Exception\EntityValidationException;
use Core\Domain\Validation\DomainValidation;
use PHPUnit\Framework\TestCase;
use Throwable;

class DomainValidationUnitTest extends TestCase
{
  public function test_not_null(): void
  {
    try {
      $value = '';
      DomainValidation::notNull($value);

      $this->assertTrue(false);
    } catch (Throwable $th) {
      $this->assertInstanceOf(EntityValidationException::class, $th);
    }
  }

  public function test_not_null_custom_exception_message(): void
  {
    try {
      $value = '';
      DomainValidation::notNull($value, "custom error message");

      $this->assertTrue(false);
    } catch (Throwable $th) {
      $this->assertInstanceOf(EntityValidationException::class, $th, "custom error message");
    }
  }

  public function test_str_max_length(): void
  {
    try {
      $value = 'Teste';
      DomainValidation::strMaxLength($value, 3, "Custom message");

      $this->assertTrue(false);
    } catch (Throwable $th) {
      $this->assertInstanceOf(EntityValidationException::class, $th);
    }
  }

  public function test_str_min_length(): void
  {
    try {
      $value = 'Test';
      DomainValidation::strMinLength($value, 8, "Custom message");

      $this->assertTrue(false);
    } catch (Throwable $th) {
      $this->assertInstanceOf(EntityValidationException::class, $th);
    }
  }

  public function test_str_can_null_and_max_length(): void
  {
    try {
      $value = 'teste';
      DomainValidation::strCanNullAndMaxLength($value, 3, "Custom message");

      $this->assertTrue(false);
    } catch (Throwable $th) {
      $this->assertInstanceOf(EntityValidationException::class, $th);
    }
  }
}
