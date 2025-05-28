<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;



class WebsiteMenu extends Model
{
    use HasFactory, SoftDeletes;


    protected $table = 'website_menus';

    protected $fillable = [
        'name',
        'slug',
        'order',
        'parent_id',
        'status'
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

    public function parent()
    {
        return $this->belongsTo(WebsiteMenu::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(WebsiteMenu::class, 'parent_id')->orderBy('order');
    }

    public function allChildren()
    {
        return $this->children()->with('allChildren');
    }

    public function page()
    {
        return $this->hasOne(WebsitePage::class, 'menu_id');
    }
}
