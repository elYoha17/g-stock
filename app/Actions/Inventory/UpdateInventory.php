<?php

namespace App\Actions\Inventory;

use App\Models\Inventory;
use App\Models\Purchase;
use Illuminate\Support\Facades\DB;

class UpdateInventory
{
    public function __invoke(Inventory $inventory, array $data): Inventory
    {
        return DB::transaction(function() use ($inventory, $data) {
            $inventory->update($data['inventory']);
            $result = app(UpdateInventoriedProducts::class)($inventory, $data['products']);

            if (collect($result)->flatten()->isNotEmpty()) {
                $inventory->touch();
            }

            return $inventory;
        });
    }
}
