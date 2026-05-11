<?php

namespace App\Policies;

use App\Enums\TeamPermission;
use App\Models\Team;
use App\Models\User;

class InventoryPolicy
{
    public function create(User $user, Team $team): bool
    {
        if ($user->current_team_id !== $team->id) {
            return false;
        }

        return $user->hasTeamPermission($team, TeamPermission::CreateInventory);
    }
}
