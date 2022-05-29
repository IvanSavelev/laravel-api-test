<?php

declare(strict_types=1);

namespace App\Http\Services;

class ApiResponse
{
    private int $status = 1;
    private ?array $data;
    private ?string $error = null;

    public function __construct(?array $data = null)
    {
        $this->data = $data;
    }

    public function get(): \Illuminate\Http\JsonResponse
    {
        return response()->json(['status' => $this->status, 'error' => $this->error, 'data' => $this->data]);
    }

    public function setError(string $error): static
    {
        $this->error = $error;
        $this->status = 0;

        return $this;
    }
}
