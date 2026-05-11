<?php

namespace App\Actions\Inventory;

use App\Models\Inventory;
use App\Models\Team;
use Illuminate\Support\Facades\DB;

class CreateInventory
{
    public function __construct(
        protected AttachInventoriedProducts $attach,
    ) {}

    public function __invoke(Team $team, array $inventoryData, array $productsData): Inventory
    {
        return DB::transaction(function () use ($team, $inventoryData, $productsData) {
            $inventory = $team->inventories()->create($inventoryData);

            ($this->attach)($inventory, $productsData);

            return $inventory;
        });
    }
}
