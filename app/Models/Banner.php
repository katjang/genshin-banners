<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Models\Character;

class Banner extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function featured(): BelongsToMany
    {
        return $this->BelongsToMany(Character::class);
    }
}
