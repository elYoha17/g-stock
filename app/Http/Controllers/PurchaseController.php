<?php

namespace App\Http\Controllers;

use App\Actions\Purchase\CreatePurchase;
use App\Http\Requests\StorePurchaseRequest;
use App\Models\Team;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    public function store(StorePurchaseRequest $request, Team $currentTeam): RedirectResponse
    {
        app(CreatePurchase::class)($currentTeam, $request->only('date'), $request->input('products'));

        return back();
    }
}
