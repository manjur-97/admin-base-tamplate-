<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Tanent extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'mobile',
        'email',
        'address',
        'password',
        'otp',
        'is_mobile_verified',
    ];

    protected static function boot()
    {
        parent::boot();
        static::saving(function ($model) {
            $model->created_at = now();
        });

        static::updating(function ($model) {
            $model->updated_at = now();
        });
    }

    protected $hidden = [
        'password',
        'remember_token',
    ];
}
