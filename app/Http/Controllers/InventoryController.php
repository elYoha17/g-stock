<?php

namespace App\Http\Controllers;

use App\Actions\Inventory\CreateInventory;
use App\Actions\Inventory\DeleteInventory;
use App\Actions\Inventory\UpdateInventory;
use App\Http\Requests\StoreInventoryRequest;
use App\Http\Requests\UpdateInventoryRequest;
use App\Models\Inventory;
use App\Models\Team;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    use AuthorizesRequests;

    public function store(StoreInventoryRequest $request, Team $currentTeam)
    {
        $inventoryData = $request->validated('inventory');
        $productsData = $request->validated('products');

        app(CreateInventory::class)($currentTeam, $inventoryData, $productsData);

        return back();
    }

    public function update(UpdateInventoryRequest $request, Team $currentTeam, Inventory $inventory): RedirectResponse
    {
        $inventoryData = $request->validated('inventory');
        $productsData = $request->validated('products');

        app(UpdateInventory::class)($inventory, $inventoryData, $productsData);

        return back();
    }

    public function destroy(Team $currentTeam, Inventory $inventory): RedirectResponse
    {
        $this->authorize('delete', [
            $inventory,
            $currentTeam,
        ]);

        app(DeleteInventory::class)($inventory);

        return back();
    }
}
