<?php

namespace App\Actions\Inventory;

use App\Actions\MakeAttachableArray;
use App\Models\Inventory;

class UpdateInventoriedProducts
{
    protected string $key = 'product_id';

    public function __invoke(Inventory $inventory, array $data): array
    {
        $data = app(MakeAttachableArray::class)($data, $this->key);

        return $inventory->products()->sync($data);
    }
}
