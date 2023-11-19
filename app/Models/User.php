<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Auth\Authenticatable;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;


class User extends Eloquent implements AuthenticatableContract
{
    use Authenticatable, HasFactory, SoftDeletes, Notifiable  ;
    protected $connection = 'mongodb';
    public $timestamps = false;
    protected $fillable = [
        'image',
        'name',
        'email',
        'password',
        'phone',
        'status',
        'address',
        'role',
        'deleted_at'
    ];
    protected $hidden = [
        'password'
    ];
    protected $attributes = [
        'status'  => 0,
        'role'    => 2,
        'image'   => 'https://res.cloudinary.com/dteefej4w/image/upload/v1681474078/users/585e4bf3cb11b227491c339a_gtyczj.png',
        'phone'   => '',
        'address' => '',
        'deleted_at' => null
    ];
}
