<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use App\Models\Banner;

trait Featurable 
{
    public function banners(): MorphToMany
    {
        return $this->morphToMany(Banner::class, 'featured')->orderBy('end_date', 'DESC');
    }

    protected function getLastBannerAttribute() 
    {
        return $this->banners()->orderBy('end_date', 'ASC')->first();
    }
}
