<?php

namespace App\Http\Controllers;

use App\Actions\Purchase\CreatePurchase;
use App\Actions\Purchase\DeletePurchase;
use App\Actions\Purchase\UpdatePurchase;
use App\Http\Requests\StorePurchaseRequest;
use App\Http\Requests\UpdatePurchaseRequest;
use App\Models\Purchase;
use App\Models\Team;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    use AuthorizesRequests;

    public function store(StorePurchaseRequest $request, Team $currentTeam): RedirectResponse
    {
        app(CreatePurchase::class)($currentTeam, $request->validated());

        return back();
    }

    public function update(UpdatePurchaseRequest $request, Team $currentTeam, Purchase $purchase): RedirectResponse
    {
        app(UpdatePurchase::class)($purchase, $request->validated());

        return back();
    }

    public function destroy(Request $request, Team $currentTeam, Purchase $purchase): RedirectResponse
    {
        $this->authorize('delete', [$purchase, $currentTeam]);

        app(DeletePurchase::class)($purchase);

        return back();
    }
}
