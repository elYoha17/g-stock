<?php

namespace App\Actions\Inventory;

use App\Models\Inventory;
use App\Models\Team;
use Illuminate\Support\Facades\DB;

class CreateInventory
{
    public function __invoke(Team $team, array $data): Inventory
    {
        return DB::transaction(function () use ($team, $data) {
            $inventory = $team->inventories()->create($data['inventory']);
            app(AttachInventoriedProduct::class)($inventory, $data['products']);

            return $inventory;
        });
    }
}
