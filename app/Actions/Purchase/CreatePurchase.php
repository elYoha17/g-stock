<?php

namespace App\Actions\Purchase;

use App\Models\Purchase;
use App\Models\Team;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class CreatePurchase
{
    public function __invoke(Team $team, array $data): Purchase
    {
        return DB::transaction(function () use ($team, $data) {
            $purchase = $team->purchases()->create($data['purchase']);
            app(AttachProduct::class)($purchase, $data['products']);
            
            return $purchase;
        });
    }
}
