<?php

namespace App\Policies;

use App\Enums\TeamPermission;
use App\Models\User;

class ProductPolicy
{
    public function create(User $user): bool
    {
        if (!$team = $user->currentTeam) {
            return false;
        }

        return $user->hasTeamPermission($team, TeamPermission::CreateProduct);
    }
}
