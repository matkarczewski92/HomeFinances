<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Savings extends Model
{
    use HasFactory;

    public function getSum()
    {
        return $this->hasMany(Finances::class, 'saving', 'id');
    }
}
