<?php

namespace App\Http\Controllers;

use App\Actions\Purchase\CreatePurchase;
use App\Actions\Purchase\DeletePurchase;
use App\Http\Requests\StorePurchaseRequest;
use App\Models\Purchase;
use App\Models\Team;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class PurchaseController extends Controller
{
    public function store(StorePurchaseRequest $request, Team $currentTeam): RedirectResponse
    {
        app(CreatePurchase::class)($currentTeam, $request->only('date'), $request->input('products'));

        return back();
    }

    public function destroy(Request $request, Team $currentTeam, Purchase $purchase): RedirectResponse
    {
        Gate::authorize('delete', [$purchase, $currentTeam]);

        app(DeletePurchase::class)($purchase);

        return back();
    }
}
