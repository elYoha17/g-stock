<?php

namespace App\Policies;

use App\Enums\TeamPermission;
use App\Models\Product;
use App\Models\Team;
use App\Models\User;

class ProductPolicy
{
    public function create(User $user, Team $team): bool
    {
        return $user->hasTeamPermission($team, TeamPermission::CreateProduct);
    }

    public function update(User $user, Product $product, Team $team): bool
    {
        if ($team->id !== $product->team_id) {
            return false;
        }

        return $user->hasTeamPermission($team, TeamPermission::UpdateProduct);
    }

    public function delete(User $user, Product $product, Team $team): bool
    {
        if ($team->id !== $product->team_id) {
            return false;
        }

        return $user->hasTeamPermission($team, TeamPermission::DeleteProduct);
    }
}
