<?php

namespace App\Actions\Purchase;

use App\Models\Purchase;
use Illuminate\Support\Facades\DB;

class UpdatePurchase
{
    public function __construct(
        protected ChangePurchasedProducts $change,
    ) {}

    public function __invoke(Purchase $purchase, array $purchaseData, array $productsData): Purchase
    {
        return DB::transaction(function () use ($purchase, $purchaseData, $productsData) {
            $purchase->update($purchaseData);
            
            $result = ($this->change)($purchase, $productsData);

            if (collect($result)->flatten()->isNotEmpty()) {
                $purchase->touch();
            }
            
            return $purchase;
        });
    }
}
