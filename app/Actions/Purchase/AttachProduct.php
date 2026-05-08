<?php

namespace App\Actions\Purchase;

use App\Actions\MakeAttachableArray;
use App\Models\Purchase;

class AttachProduct
{
    public function __invoke(Purchase $purchase, array $productsData): void
    {
        $data = app(MakeAttachableArray::class)($productsData, 'product_id');
        $purchase->products()->attach($data);
    }
}
