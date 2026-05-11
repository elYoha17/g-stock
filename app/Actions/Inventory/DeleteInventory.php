<?php

namespace App\Actions\Inventory;

use App\Models\Inventory;

class DeleteInventory
{
    public function __invoke(Inventory $inventory): bool
    {
        return (bool) $inventory->delete();
    }
}
