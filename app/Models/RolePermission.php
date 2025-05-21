<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RolePermission extends Model
{
    use HasFactory;

    protected $fillable = [
        'role_id', 
        'uri', 
        'name', 
        'controller_function', 
        'method', 
        'controller_name'
    ];

    /**
     * Relationship with Role.
     * A permission belongs to one role.
     */
    public function role()
    {
        return $this->belongsTo(Role::class)->withDefault(); // withDefault handles null role_id
    }

  
}
