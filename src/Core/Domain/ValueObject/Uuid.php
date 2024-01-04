<?php

namespace Core\Domain\ValueObject;

use InvalidArgumentException;
use Ramsey\Uuid\Uuid as RamseyUuid;

class Uuid
{
  public function __construct(
    protected string $value
  ) {
    $this->ensureIsValid($value);
  }

  public static function random(): self
  {
    $uuid = RamseyUuid::uuid4()->toString();
    return new self($uuid);
  }

  public function __toString()
  {
    return $this->value;
  }

  private function ensureIsValid(string $id): void
  {
    $isNotValidUuid = !RamseyUuid::isValid($id);
    if ($isNotValidUuid)
      throw new InvalidArgumentException(sprintf("<%s> does not allow the value <%s>.", static::class, $id));
  }
}
