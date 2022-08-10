<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table='user';
    protected $primaryKey='user_id';
//   public $timestamps=false;
    const MANAGER = 1;
    const ADMIN = 2;
    const USER = 3;
    const active=1;
    const deactive=0;

    protected $fillable = [
        'name', 'username', 'password','email',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


}
