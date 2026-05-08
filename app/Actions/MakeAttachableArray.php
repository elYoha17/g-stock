<?php

namespace App\Actions;

use Illuminate\Support\Arr;

class MakeAttachableArray
{
    public function __invoke(array $rawData, string $key): array
    {
        return collect($rawData)->mapWithKeys(function ($item) use ($key) {
            return [
                $item[$key] => Arr::except($item, [$key])
            ];
        })->toArray();
    }
}
