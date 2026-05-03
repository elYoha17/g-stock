<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

#[Table(incrementing: true)]
class PurchasedProduct extends Pivot
{
    use HasFactory;

    public $timestamps = true;
}
