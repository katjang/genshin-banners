<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Casts\Attribute;
use App\Models\Banner;

class Character extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function banners(): belongsToMany
    {
        return $this->belongsToMany(Banner::class)->orderBy('end_date', 'DESC');
    }

    protected function getLastBannerAttribute() {
        return $this->banners()->orderBy('end_date', 'ASC')->first();
    }
}
