<?php

namespace App\Http\Controllers;

use App\Actions\Product\CreateProduct;
use App\Http\Requests\StoreProductRequest;
use Illuminate\Http\RedirectResponse;

class ProductController extends Controller
{
    public function store(StoreProductRequest $request): RedirectResponse
    {
        $team = $request->user()->currentTeam;

        app(CreateProduct::class)($team, $request->validated());

        return back();
    }
}
