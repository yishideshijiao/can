<?php

namespace App\Models;


use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class Admin extends Authenticatable
{
    protected $fillable=[
        'name','email','password'
    ];

    use HasRoles;
    protected $guard_name = 'admin'; // 使用任何你想要的守卫
}
