<?php

namespace App\Enums;

enum TeamPermission: string
{
    case UpdateTeam = 'team:update';
    case DeleteTeam = 'team:delete';

    case AddMember = 'member:add';
    case UpdateMember = 'member:update';
    case RemoveMember = 'member:remove';

    case CreateInvitation = 'invitation:create';
    case CancelInvitation = 'invitation:cancel';

    case CreateProduct = 'product:create';
    case UpdateProduct = 'product:update';
    case DeleteProduct = 'product:delete';

    case CreatePurchase = 'purchase:create';
    case UpdatePurchase = 'purchase:update';
    case DeletePurchase = 'purchase:delete';

    case CreateInventory = 'inventory:create';
    case UpdateInventory = 'inventory:update';
}
