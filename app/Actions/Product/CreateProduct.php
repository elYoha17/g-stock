<?php

namespace App\Actions\Product;

use App\Models\Product;
use App\Models\Team;

class CreateProduct
{
    public function __invoke(Team $team, array $data): Product
    {
        return $team->products()->create($data);
    }
}
