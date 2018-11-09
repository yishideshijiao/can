<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Adress extends Model
{
    protected $fillable=[
        'name','tel','user_id','status','provence','city','area','detail_address'
    ];
}
