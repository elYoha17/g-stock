<?php

namespace App\Http\Controllers;

use App\Actions\Product\CreateProduct;
use App\Actions\Product\DeleteProduct;
use App\Actions\Product\UpdateProduct;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use App\Models\Team;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\RedirectResponse;

class ProductController extends Controller
{
    use AuthorizesRequests;

    public function store(StoreProductRequest $request, Team $currentTeam): RedirectResponse
    {
        app(CreateProduct::class)($currentTeam, $request->validated());

        return back();
    }

    public function update(UpdateProductRequest $request, Team $currentTeam, Product $product): RedirectResponse
    {
        app(UpdateProduct::class)($product, $request->validated());

        return back();
    }

    public function destroy(Team $currentTeam, Product $product):RedirectResponse
    {
       $this->authorize('delete', [$product, $currentTeam]);

        app(DeleteProduct::class)($product);

        return back();
    }
}
