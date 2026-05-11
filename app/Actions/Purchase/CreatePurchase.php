<?php

namespace App\Actions\Purchase;

use App\Models\Purchase;
use App\Models\Team;
use Illuminate\Support\Facades\DB;

class CreatePurchase
{
    public function __construct(
        protected AttachPurchasedProducts $attach,
    ) {}

    public function __invoke(Team $team, array $purchaseData, array $productsData): Purchase
    {
        return DB::transaction(function () use ($team, $purchaseData, $productsData) {
            $purchase = $team->purchases()->create($purchaseData);

            ($this->attach)($purchase, $productsData);
            
            return $purchase;
        });
    }
}
