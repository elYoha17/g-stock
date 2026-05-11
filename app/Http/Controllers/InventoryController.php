<?php

namespace App\Http\Controllers;

use App\Actions\Inventory\CreateInventory;
use App\Http\Requests\StoreInventoryRequest;
use App\Models\Team;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    public function store(StoreInventoryRequest $request, Team $currentTeam)
    {
        app(CreateInventory::class)($currentTeam, $request->validated());

        return back();
    }
}
