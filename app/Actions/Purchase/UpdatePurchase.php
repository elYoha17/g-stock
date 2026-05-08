<?php

namespace App\Actions\Purchase;

use App\Models\Purchase;
use Illuminate\Support\Facades\DB;

class UpdatePurchase
{
    public function __invoke(Purchase $purchase, array $data): Purchase
    {
        return DB::transaction(function () use ($purchase, $data) {
            $purchase->update($data['purchase']);
            app(UpdateAttachedProduct::class)($purchase, $data['products']);
            
            return $purchase;
        });
    }
}
