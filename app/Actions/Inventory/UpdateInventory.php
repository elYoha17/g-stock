<?php

namespace App\Actions\Inventory;

use App\Models\Inventory;
use Illuminate\Support\Facades\DB;

class UpdateInventory
{
    public function __construct(
        protected ChangeInventoriedProducts $change,
    ) {}

    public function __invoke(Inventory $inventory, array $inventoryData, array $productsData): Inventory
    {
        return DB::transaction(function() use ($inventory, $inventoryData, $productsData) {
            $inventory->update($inventoryData);
            
            $result = ($this->change)($inventory, $productsData);

            if (collect($result)->flatten()->isNotEmpty()) {
                $inventory->touch();
            }

            return $inventory;
        });
    }
}
