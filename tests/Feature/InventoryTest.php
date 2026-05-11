<?php

namespace Tests\Feature;

use App\Models\InventoriedProduct;
use App\Models\Inventory;
use App\Models\Product;
use App\Models\Team;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class InventoryTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_create_inventory(): void
    {
        /** @var User */
        $user = User::factory()->configure()->create();
        $products = $this->createProducts($user->current_team_id, 8);

        $inventory = Inventory::factory()->make();

        $usedProducts = $products->shuffle()->take(4);
        $inventoriedProducts = $usedProducts->map(fn ($product) => InventoriedProduct::factory()->make([
            'product_id' => $product->id,
        ]));

        $payload = [
            'inventory' => $inventory->toArray(),
            'products' => $inventoriedProducts->toArray(),
        ];

        $response = $this->actingAs($user)
            ->post(route('inventories.store'), $payload);

        $response->assertRedirect();

        $this->assertDatabaseHas('inventories', [
            'date' => $payload['inventory']['date'],
        ]);

        $this->assertDatabaseCount('inventoried_product', 4);
    }
    
    private function createProducts(Team|int $team, int $count): Collection
    {
        if ($team instanceof Team) {
            $team = $team->id;
        }

        return Product::factory()->count($count)->create([
            'team_id' => $team,
        ]);
    }
}
