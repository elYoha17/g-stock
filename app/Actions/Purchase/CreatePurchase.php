<?php

namespace App\Actions\Purchase;

use App\Models\Purchase;
use App\Models\Team;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class CreatePurchase
{
    public function __invoke(Team $team, array $data, array $productData): Purchase
    {
        return DB::transaction(function () use ($team, $data, $productData) {
            $purchase = $team->purchases()->create($data);
            $purchase->products()->attach(
                collect($productData)->mapWithKeys(function ($item) {
                    return [
                        $item['product_id'] => Arr::except($item, ['product_id'])
                    ];
                })->toArray()
            );
            return $purchase;
        });
    }
}
