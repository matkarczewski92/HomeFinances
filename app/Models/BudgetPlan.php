<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class BudgetPlan extends Model
{
    use HasFactory;

    public function categoryDetails(): HasOne
    {
        return $this->hasOne(Category::class, 'id', 'category');
    }
}
