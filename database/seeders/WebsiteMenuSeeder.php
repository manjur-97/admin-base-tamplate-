<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\WebsiteMenu;

class WebsiteMenuSeeder extends Seeder
{
    public function run()
    {
        // Main Menu Items
        $home = WebsiteMenu::create([
            'name' => 'Home',
            'slug' => 'home',
            'order' => 1,
            'status' => 'Active'
        ]);

        $about = WebsiteMenu::create([
            'name' => 'About',
            'slug' => 'about',
            'order' => 2,
            'status' => 'Active'
        ]);

        $contact = WebsiteMenu::create([
            'name' => 'Contact',
            'slug' => 'contact',
            'order' => 4,
            'status' => 'Active'
        ]);

        // Gallery with sub-items
        $gallery = WebsiteMenu::create([
            'name' => 'Gallery',
            'slug' => 'gallery',
            'order' => 3,
            'status' => 'Active'
        ]);

        // Gallery Sub-items
        WebsiteMenu::create([
            'name' => 'Video Gallery',
            'slug' => 'video-gallery',
            'order' => 1,
            'parent_id' => $gallery->id,
            'status' => 'Active'
        ]);

        WebsiteMenu::create([
            'name' => 'Image Gallery',
            'slug' => 'image-gallery',
            'order' => 2,
            'parent_id' => $gallery->id,
            'status' => 'Active'
        ]);
    }
}
