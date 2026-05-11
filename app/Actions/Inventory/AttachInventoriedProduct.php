<?php

namespace App\Actions\Inventory;

use App\Actions\MakeAttachableArray;
use App\Models\Inventory;

class AttachInventoriedProduct
{
    protected string $key = 'product_id';

    public function __invoke(Inventory $inventory, array $data): void
    {
        $data = app(MakeAttachableArray::class)($data, $this->key);
        $inventory->products()->attach($data);
    }
}
