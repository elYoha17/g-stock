<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     */
    public function test_user_can_create_product(): void
    {
        /** @var User */
        $user = User::factory()->configure()->create();
        $playload = Product::factory()->make()->toArray();

        $response = $this->actingAs($user)
            ->post(route('products.store'), $playload);

        $response->assertRedirect();

        $this->assertDatabaseHas('products', $playload);
    }
}
