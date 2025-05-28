<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;



class WebsitePage extends Model
{
    use HasFactory, SoftDeletes;


    protected $table = 'website_pages';

    protected $fillable = [
        'menu_id',
        'name',
        'slug',
        'components'
    ];

    protected $casts = [
        'components' => 'array'
    ];

    protected static function boot()
    {
        parent::boot();
        static::saving(function ($model) {
            $model->created_at = date('Y-m-d H:i:s');
        });

        static::updating(function ($model) {
            $model->updated_at = date('Y-m-d H:i:s');
        });
    }
    public function menu()
    {
        return $this->belongsTo(WebsiteMenu::class, 'menu_id')->withDefault();
    }
}
