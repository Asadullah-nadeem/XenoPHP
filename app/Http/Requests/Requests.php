<?php

namespace App\Http\Requests;

abstract class Requests {
  public function __construct(
    protected array $input = [],
  ) {}

  abstract public function authorize(): bool;

  abstract public function rules(): array;

  public function all(): array {
    return $this->input;
  }

  public function input(string $key, mixed $default = null): mixed {
    return $this->input[$key] ?? $default;
  }
}
