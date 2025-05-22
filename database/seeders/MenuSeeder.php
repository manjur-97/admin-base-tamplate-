<?php

namespace Database\Seeders;

use App\Models\Menu; // Correct import
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
        $menus = $this->datas();
        $menuMap = [];


        foreach ($menus as $menuData) {
            $menu = $this->createMenu($menuData);
            $key = $this->generateParentKey($menuData['name'], $menuData['permission_name']);
            $menuMap[$key] = $menu->id;
        }


        foreach ($menus as $menuData) {
            if (!empty($menuData['parent_name'])) {
                $parentPermission = $menuData['permission_name']; // বর্তমান মেনুর permission_name ব্যবহার করুন
                $parentKey = $this->generateParentKey($menuData['parent_name'], $parentPermission);

                if (isset($menuMap[$parentKey])) {
                    Menu::where('name', $menuData['name'])
                        ->where('permission_name', $menuData['permission_name'])
                        ->update(['parent_id' => $menuMap[$parentKey]]);
                }
            }
        }
    }

    private function generateParentKey($name, $permission)
    {
        return $name . '-' . $permission; // Example: "Dashboard-admin", "Dashboard-employee"
    }

    private function createMenu($data)
    {
        $menu = new Menu([
            'name' => $data['name'],
            'icon' => $data['icon'],
            'route' => $data['route'],
            'description' => $data['description'],
            'sorting' => $data['sorting'],
            'permission_name' => $data['permission_name'],
            'status' => $data['status'],
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null,
        ]);

        $menu->save();
        return $menu;
    }

    private function datas()
    {


        return [
            [

                'name' => 'Dashboard',
                'icon' => 'fas fa-home',
                'route' => 'backend.dashboard',
                'description' => 'Main dashboard overview',
                'sorting' => 1,
                'parent_name' => null,
                'permission_name' => 'admin',
                'status' => 'Active',
            ],
            [

                'name' => 'Website Menu',
                'icon' => 'fas fa-home',
                'route' => 'backend.websitemenu.index',
                'description' => 'Website Menu',
                'sorting' => 2,
                'parent_name' => null,
                'permission_name' => 'admin',
                'status' => 'Active',
            ],
            [

                'name' => 'Website Page',
                'icon' => 'fas fa-home',
                'route' => 'backend.websitepage.index',
                'description' => 'Website Page',
                'sorting' => 3,
                'parent_name' => null,
                'permission_name' => 'admin',
                'status' => 'Active',
            ],
            [

                'name' => 'Software Setting',
                'icon' => 'fas fa-cogs',
                'route' => null,
                'description' => null,
                'sorting' => 12,
                'parent_name' => null,
                'permission_name' => 'admin',
                'status' => 'Active',
            ],

            [

                'name' => 'User',
                'icon' => 'fas fa-users',
                'route' => 'backend.user.index',
                'description' => 'User',
                'sorting' => 1,
                'parent_name' => 'Software Setting',
                'permission_name' => 'admin',
                'status' => 'Active',
            ],
            [

                'name' => 'Role & Permission',
                'icon' => 'fas fa-users',
                'route' => 'backend.role.index',
                'description' => 'Role & Permission',
                'sorting' => 2,
                'parent_name' => 'Software Setting',
                'permission_name' => 'admin',
                'status' => 'Active',
            ],

        ];
    }
}
