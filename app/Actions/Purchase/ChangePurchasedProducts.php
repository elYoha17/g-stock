<?php

namespace App\Actions\Purchase;

use App\Actions\FormatPivotPayload;
use App\Models\Purchase;

class ChangePurchasedProducts
{
    protected string $key = 'product_id';

    public function __construct(
        protected FormatPivotPayload $format,
    ) {}

    public function __invoke(Purchase $purchase, array $productsData): array
    {
        $data = ($this->format)($productsData, $this->key);
        
        return $purchase->products()->sync($data);
    }
}
