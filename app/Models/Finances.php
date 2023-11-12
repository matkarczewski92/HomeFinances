<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Finances extends Model
{
    use HasFactory;

    public function categoryDetails(): HasOne
    {
        return $this->hasOne(Category::class, 'id', 'category');
    }

    public function groupDetails(): HasOne
    {
        return $this->hasOne(Group::class, 'id', 'group');
    }

    public function savingDetails(): HasOne
    {
        return $this->hasOne(Savings::class, 'id', 'saving');
    }
}
