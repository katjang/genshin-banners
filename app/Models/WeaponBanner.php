<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WeaponBanner extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function featured(): BelongsToMany
    {
        return $this->BelongsToMany(Character::class, 'weapon_feature');
    }
}
