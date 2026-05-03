<?php

namespace App\Policies;

use App\Enums\TeamPermission;
use App\Models\Team;
use App\Models\User;

class PurchasePolicy
{
    public function create(User $user, Team $team): bool
    {
        return $user->hasTeamPermission($team, TeamPermission::CreatePurchase);
    }
}
