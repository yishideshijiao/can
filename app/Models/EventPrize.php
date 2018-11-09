<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventPrize extends Model
{
    protected $fillable=[
        'event_id','name','description','user_id',''
    ];

    public function event()
    {
        return $this->belongsTo(Event::class,"event_id");
    }
//与用户表连接
    public function user()
    {
        return $this->hasMany(User::class,"user_id");
    }
}
