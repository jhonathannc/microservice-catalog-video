<?php

namespace Core\Domain\Validation;

use Core\Domain\Exception\EntityValidationException;

class DomainValidation
{
  public static function notNull(string $value, string $exceptionMessage = null): void
  {
    $exceptionMessage = $exceptionMessage ?? "The value should not be empty";

    $isEmptyValue = empty($value);
    if ($isEmptyValue) throw new EntityValidationException($exceptionMessage);
  }

  public static function strMaxLength(string $value, int $length = 255, string $exceptionMessage = null): void
  {
    $exceptionMessage = $exceptionMessage ?? "The value must not be greater than {$length} characters";

    $hasMaxLength = strlen($value) > $length;
    if ($hasMaxLength)
      throw new EntityValidationException($exceptionMessage);
  }

  public static function strMinLength(string $value, int $length = 2, string $exceptionMessage = null): void
  {
    $exceptionMessage = $exceptionMessage ?? "The value must be at least than {$length} characters";

    $hasMinLength = strlen($value) < $length;
    if ($hasMinLength)
      throw new EntityValidationException($exceptionMessage);
  }

  public static function strCanNullAndMaxLength(string $value = '', int $length = 255, string $exceptionMessage = null): void
  {
    $exceptionMessage = $exceptionMessage ?? "The value must not be greater than {$length} characters";

    $strNotNull = !empty($value);
    $hasMaxLength = strlen($value) > $length;
    if ($strNotNull && $hasMaxLength)
      throw new EntityValidationException($exceptionMessage);
  }
}
