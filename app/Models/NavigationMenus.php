<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NavigationMenus extends Model
{
    use HasFactory;

    protected $fillable = [
        'label',
        'slug',
        'sequence',
        'type',
    ];
}
