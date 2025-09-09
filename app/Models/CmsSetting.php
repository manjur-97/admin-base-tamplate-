<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CmsSetting extends Model
{
    protected $fillable = [
        'header',
        'footer',
        'form',
        'gallery',
        'slider',
        'page_header',
        'website_id'
    ];

    // Get all settings
    public static function getSettings()
    {
        return self::first() ?? new self();
    }

    // Update settings
    public static function updateSettings($data)
    {
        $settings = self::first() ?? new self();
        $settings->fill($data);
        $settings->save();
        return $settings;
    }

    // Get specific component
    public static function getComponent($component)
    {
        $settings = self::first();
        return $settings ? $settings->$component : null;
    }
}
