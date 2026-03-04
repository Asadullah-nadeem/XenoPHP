<?php

namespace App\Model;

abstract class Model {
  public function __construct(
    protected array $attributes = [],
  ) {}

  public function getAttributes(): array {
    return $this->attributes;
  }

  protected function getAttribute(string $key): mixed {
    return $this->attributes[$key] ?? null;
  }
}
