<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Character;

class Banner extends Model
{
    use HasFactory;

    public function featuredCharacters(): HasMany
    {
        return $this->hasMany(Character::class);
    }
}
