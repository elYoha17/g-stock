<?php

namespace App\Actions\Purchase;

use App\Actions\MakeAttachableArray;
use App\Models\Purchase;

class UpdateAttachedProduct
{
    public function __invoke(Purchase $purchase, array $productsData): array
    {
        $data = app(MakeAttachableArray::class)($productsData, 'product_id');
        
        return $purchase->products()->sync($data);
    }
}
