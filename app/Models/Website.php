<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Website extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'tanent_id',
        'category_id',
        'logo',
        'title',
        'slug',
        'description',
        'status',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    

    public function tanent()
    {
        return $this->belongsTo(Tanent::class);
    }
}
