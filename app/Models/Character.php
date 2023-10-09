<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Banner;

class Character extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function characters(): HasMany
    {
        return $this->hasMany(Banner::class);
    }
}
