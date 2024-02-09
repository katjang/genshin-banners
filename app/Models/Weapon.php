<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Weapon extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function banners(): belongsToMany
    {
        return $this->belongsToMany(WeaponBanner::class, 'weapon_feature')->orderBy('end_date', 'DESC');
    }

    protected function getLastBannerAttribute() {
        return $this->banners()->orderBy('end_date', 'ASC')->first();
    }
}
