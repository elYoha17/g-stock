<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\Purchase;
use App\Models\PurchasedProduct;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PurchaseTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_create_purchase(): void
    {
        $count = 3;

        /** @var User */
        $user = User::factory()->configure()->create();
        $products = Product::factory()->count($count)->create([
            'team_id' => $user->current_team_id,
        ]);

        $purchasePayload = Purchase::factory()->make()->toArray();
        $purchasedProductPayload = [];
        foreach($products as $product) {
            $purchasedProductPayload[] = PurchasedProduct::factory()->make([
                'product_id' => $product->id,
            ])->toArray();
        }

        $payload = [
            ...$purchasePayload,
            'products' => $purchasedProductPayload,
        ];

        $response = $this->actingAs($user)
            ->post(route('purchases.store'), $payload);

        $response->assertRedirect();

        $this->assertDatabaseHas('purchases', [
            'date' => $payload['date'],
        ]);

        $this->assertDatabaseCount('purchased_product', $count);
    }

    public function test_user_can_delete_purchase(): void
    {
        $count = 3;
        /** @var User */
        $user = User::factory()->configure()->create();
        $products = Product::factory()->count($count)->create([
            'team_id' => $user->current_team_id,
        ]);
        $purchase = Purchase::factory()->create([
            'team_id' => $user->current_team_id,
        ]);

        foreach ($products as $product) {
            PurchasedProduct::factory()->create([
                'product_id' => $product->id,
                'purchase_id' => $purchase->id,
            ]);
        }

        $response = $this->actingAs($user)
            ->delete(route('purchases.destroy', $purchase));

        $response->assertRedirect();

        $this->assertDatabaseMissing('purchases', [
            'id' => $purchase->id,
        ]);

        $this->assertDatabaseEmpty('purchased_product');
    }
}
