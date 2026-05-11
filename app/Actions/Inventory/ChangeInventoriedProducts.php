<?php

namespace App\Actions\Inventory;

use App\Actions\FormatPivotPayload;
use App\Models\Inventory;

class ChangeInventoriedProducts
{
    protected string $key = 'product_id';

    public function __construct(
        protected FormatPivotPayload $format,
    ) {}
    
    public function __invoke(Inventory $inventory, array $data): array
    {
        $data = ($this->format)($data, $this->key);

        return $inventory->products()->sync($data);
    }
}
