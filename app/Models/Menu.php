<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $fillable=[
        'goods_name','cate_id','rating','goods_price','goods_content','month_sales','rating_count','title','satisfy_count','satisfy_rate','goods_img'
    ];

    public function cate()
    {
        return $this->belongsTo(MenuCategory::class,"cate_id");

    }

}
