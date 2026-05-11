<?php

namespace App\Actions\Purchase;

use App\Actions\FormatPivotPayload;
use App\Models\Purchase;

class AttachPurchasedProducts
{
    protected string $key = 'product_id';

    public function __construct(
        protected FormatPivotPayload $format,
    ) {}

    public function __invoke(Purchase $purchase, array $data): void
    {
        $data = ($this->format)($data, $this->key);

        $purchase->products()->attach($data);
    }
}
