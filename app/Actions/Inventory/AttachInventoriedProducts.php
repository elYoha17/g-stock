<?php

namespace App\Actions\Inventory;

use App\Actions\FormatPivotPayload;
use App\Models\Inventory;

class AttachInventoriedProducts
{
    protected string $key = 'product_id';

    public function __construct(
        protected FormatPivotPayload $format,
    ) {}

    public function __invoke(Inventory $inventory, array $data): void
    {
        $data = ($this->format)($data, $this->key);
        
        $inventory->products()->attach($data);
    }
}
