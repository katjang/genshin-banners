<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Featurable;

class Character extends Model
{
    use HasFactory;
    use Featurable;

    protected $guarded = ['id'];
}
