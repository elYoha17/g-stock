<?php

namespace App\Http\Controllers;

use App\Actions\Product\CreateProduct;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use App\Models\Team;
use App\UpdateProduct;
use Illuminate\Http\RedirectResponse;

class ProductController extends Controller
{
    public function store(StoreProductRequest $request, Team $currentTeam): RedirectResponse
    {
        $team = $request->user()->currentTeam;

        app(CreateProduct::class)($team, $request->validated());

        return back();
    }

    public function update(UpdateProductRequest $request, Team $currentTeam, Product $product): RedirectResponse
    {
        app(UpdateProduct::class)($product, $request->validated());

        return back();
    }
}
