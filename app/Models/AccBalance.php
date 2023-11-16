<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class AccBalance extends Model
{
    use HasFactory;

    public function accDetails(): HasOne
    {
        return $this->hasOne(AccountList::class, 'id', 'account_id');
    }
}
