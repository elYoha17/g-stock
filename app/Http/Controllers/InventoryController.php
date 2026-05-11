<?php

namespace App\Http\Controllers;

use App\Actions\Inventory\CreateInventory;
use App\Actions\Inventory\UpdateInventory;
use App\Http\Requests\StoreInventoryRequest;
use App\Http\Requests\UpdateInventoryRequest;
use App\Models\Inventory;
use App\Models\Team;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    public function store(StoreInventoryRequest $request, Team $currentTeam)
    {
        app(CreateInventory::class)($currentTeam, $request->validated());

        return back();
    }

    public function update(UpdateInventoryRequest $request, Team $currentTeam, Inventory $inventory): RedirectResponse
    {
        app(UpdateInventory::class)($inventory, $request->validated());

        return back();
    }
}
