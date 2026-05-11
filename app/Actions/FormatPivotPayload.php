<?php

namespace App\Actions;

use Illuminate\Support\Arr;

class FormatPivotPayload
{
    public function __invoke(array $rawData, string $key = "id"): array
    {
        return collect($rawData)->mapWithKeys(function ($item) use ($key) {
            return [
                $item[$key] => Arr::except($item, [$key])
            ];
        })->toArray();
    }
}
