<?php

namespace App\Actions\Purchase;

use App\Models\Purchase;

class DeletePurchase
{
    public function __invoke(Purchase $purchase): bool
    {
        return (bool) $purchase->delete();
    }
}
