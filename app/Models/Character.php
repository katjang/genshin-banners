<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Casts\Attribute;
use App\Models\Banner;

class Character extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function banners(): HasMany
    {
        return $this->hasMany(Banner::class);
    }

    protected function lastBanner(): Attribute {
        return Attribute::make(
            get: fn () => $this->banners()->last()->get()
        );
    }
}
