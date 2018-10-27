<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MenuCategory extends Model
{
    protected $fillable=[
        'name','shop_id','hao_id','describe','is_selected'
    ];
}
