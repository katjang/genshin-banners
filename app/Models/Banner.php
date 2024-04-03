<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use App\Traits\Featurable;
use App\Models\Character;
use App\Models\Weapon;

class Banner extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function weapons(): MorphToMany
    {
        return $this->morphedByMany(Weapon::class, 'featured');
    }

    public function characters(): MorphToMany
    {
        return $this->morphedByMany(Character::class, 'featured');
    }
}
