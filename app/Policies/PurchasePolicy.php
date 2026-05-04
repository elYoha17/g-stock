<?php

namespace App\Policies;

use App\Enums\TeamPermission;
use App\Models\Purchase;
use App\Models\Team;
use App\Models\User;

class PurchasePolicy
{
    public function create(User $user, Team $team): bool
    {
        return $user->hasTeamPermission($team, TeamPermission::CreatePurchase);
    }

    public function delete(User $user, Purchase $purchase, Team $team): bool
    {
        if ($team->id !== $purchase->team_id) {
            return false;
        }

        return $user->hasTeamPermission($team, TeamPermission::DeletePurchase);
    }
}
