<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolePermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('role_permissions')->insert([
            [
                'id' => 1,
                'role_id' => 2,
                'uri' => 'backend.dashboard',
                'name' => 'Dashboard',
                'controller_function' => 'index',
                'method' => 'GET|HEAD',
                'controller_name' => 'DashboardController',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 2,
                'role_id' => 2,
                'uri' => 'backend.user.status.change',
                'name' => 'User Status Change',
                'controller_function' => 'changeStatus',
                'method' => 'GET|HEAD',
                'controller_name' => 'AdminController',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 3,
                'role_id' => 2,
                'uri' => 'backend.profile',
                'name' => 'Profile',
                'controller_function' => 'profile',
                'method' => 'GET|HEAD',
                'controller_name' => 'AdminController',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 4,
                'role_id' => 2,
                'uri' => 'backend.profile.change_password',
                'name' => 'Profile Change_Password',
                'controller_function' => 'change_password',
                'method' => 'GET|HEAD',
                'controller_name' => 'AdminController',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 5,
                'role_id' => 2,
                'uri' => 'backend.profile.password_update',
                'name' => 'Profile Password_Update',
                'controller_function' => 'password_update',
                'method' => 'POST',
                'controller_name' => 'AdminController',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 6,
                'role_id' => 2,
                'uri' => 'backend.user.update',
                'name' => 'User Update',
                'controller_function' => 'update',
                'method' => 'PUT|PATCH',
                'controller_name' => 'AdminController',
                'created_at' => now(),
                'updated_at' => now()
            ],

            [
                'id' => 7,
                'role_id' => 2,
                'uri' => 'backend.user.destroy',
                'name' => 'User Destroy',
                'controller_function' => 'destroy',
                'method' => 'DELETE',
                'controller_name' => 'AdminController',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 8,
                'role_id' => 2,
                'uri' => 'backend.salary.index',
                'name' => 'Salary Index',
                'controller_function' => 'index',
                'method' => 'GET|HEAD',
                'controller_name' => 'SalaryController',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 9,
                'role_id' => 2,
                'uri' => 'backend.salary.create',
                'name' => 'Salary Create',
                'controller_function' => 'create',
                'method' => 'GET|HEAD',
                'controller_name' => 'SalaryController',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 10,
                'role_id' => 2,
                'uri' => 'backend.salary.store',
                'name' => 'Salary Store',
                'controller_function' => 'store',
                'method' => 'POST',
                'controller_name' => 'SalaryController',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 11,
                'role_id' => 2,
                'uri' => 'backend.salary.show',
                'name' => 'Salary Show',
                'controller_function' => 'show',
                'method' => 'GET|HEAD',
                'controller_name' => 'SalaryController',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 12,
                'role_id' => 2,
                'uri' => 'backend.salary.edit',
                'name' => 'Salary Edit',
                'controller_function' => 'edit',
                'method' => 'GET|HEAD',
                'controller_name' => 'SalaryController',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 13,
                'role_id' => 2,
                'uri' => 'backend.salary.update',
                'name' => 'Salary Update',
                'controller_function' => 'update',
                'method' => 'PUT|PATCH',
                'controller_name' => 'SalaryController',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 14,
                'role_id' => 2,
                'uri' => 'backend.salary.destroy',
                'name' => 'Salary Destroy',
                'controller_function' => 'destroy',
                'method' => 'DELETE',
                'controller_name' => 'SalaryController',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 15,
                'role_id' => 2,
                'uri' => 'backend.salary.status.change',
                'name' => 'Salary Status Change',
                'controller_function' => 'changeStatus',
                'method' => 'GET|HEAD',
                'controller_name' => 'SalaryController',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 16,
                'role_id' => 2,
                'uri' => 'backend.employee.index',
                'name' => 'Employee Index',
                'controller_function' => 'index',
                'method' => 'GET|HEAD',
                'controller_name' => 'EmployeeController',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 17,
                'role_id' => 2,
                'uri' => 'backend.employee.create',
                'name' => 'Employee Create',
                'controller_function' => 'create',
                'method' => 'GET|HEAD',
                'controller_name' => 'EmployeeController',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 18,
                'role_id' => 2,
                'uri' => 'backend.employee.store',
                'name' => 'Employee Store',
                'controller_function' => 'store',
                'method' => 'POST',
                'controller_name' => 'EmployeeController',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 19,
                'role_id' => 2,
                'uri' => 'backend.employee.edit',
                'name' => 'Employee Edit',
                'controller_function' => 'edit',
                'method' => 'GET|HEAD',
                'controller_name' => 'EmployeeController',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 20,
                'role_id' => 2,
                'uri' => 'backend.employee.update',
                'name' => 'Employee Update',
                'controller_function' => 'update',
                'method' => 'PUT|PATCH',
                'controller_name' => 'EmployeeController',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 21,
                'role_id' => 2,
                'uri' => 'backend.employee.destroy',
                'name' => 'Employee Destroy',
                'controller_function' => 'destroy',
                'method' => 'DELETE',
                'controller_name' => 'EmployeeController',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 22,
                'role_id' => 2,
                'uri' => 'backend.employee.status.change',
                'name' => 'Employee Status Change',
                'controller_function' => 'changeStatus',
                'method' => 'GET|HEAD',
                'controller_name' => 'EmployeeController',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 23,
                'role_id' => 2,
                'uri' => 'backend.leavetype.index',
                'name' => 'Leavetype Index',
                'controller_function' => 'index',
                'method' => 'GET|HEAD',
                'controller_name' => 'LeaveTypeController',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 24,
                'role_id' => 2,
                'uri' => 'backend.leavetype.create',
                'name' => 'Leavetype Create',
                'controller_function' => 'create',
                'method' => 'GET|HEAD',
                'controller_name' => 'LeaveTypeController',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 25,
                'role_id' => 2,
                'uri' => 'backend.leavetype.store',
                'name' => 'Leavetype Store',
                'controller_function' => 'store',
                'method' => 'POST',
                'controller_name' => 'LeaveTypeController',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 26,
                'role_id' => 2,
                'uri' => 'backend.leavetype.edit',
                'name' => 'Leavetype Edit',
                'controller_function' => 'edit',
                'method' => 'GET|HEAD',
                'controller_name' => 'LeaveTypeController',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 27,
                'role_id' => 2,
                'uri' => 'backend.leavetype.update',
                'name' => 'Leavetype Update',
                'controller_function' => 'update',
                'method' => 'PUT|PATCH',
                'controller_name' => 'LeaveTypeController',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 28,
                'role_id' => 2,
                'uri' => 'backend.leavetype.destroy',
                'name' => 'Leavetype Destroy',
                'controller_function' => 'destroy',
                'method' => 'DELETE',
                'controller_name' => 'LeaveTypeController',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 29,
                'role_id' => 2,
                'uri' => 'backend.section.index',
                'name' => 'Section Index',
                'controller_function' => 'index',
                'method' => 'GET|HEAD',
                'controller_name' => 'SectionController',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 30,
                'role_id' => 2,
                'uri' => 'backend.section.create',
                'name' => 'Section Create',
                'controller_function' => 'create',
                'method' => 'GET|HEAD',
                'controller_name' => 'SectionController',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 31,
                'role_id' => 2,
                'uri' => 'backend.section.store',
                'name' => 'Section Store',
                'controller_function' => 'store',
                'method' => 'POST',
                'controller_name' => 'SectionController',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 32,
                'role_id' => 2,
                'uri' => 'backend.section.edit',
                'name' => 'Section Edit',
                'controller_function' => 'edit',
                'method' => 'GET|HEAD',
                'controller_name' => 'SectionController',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 33,
                'role_id' => 2,
                'uri' => 'backend.section.update',
                'name' => 'Section Update',
                'controller_function' => 'update',
                'method' => 'PUT|PATCH',
                'controller_name' => 'SectionController',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 34,
                'role_id' => 2,
                'uri' => 'backend.section.destroy',
                'name' => 'Section Destroy',
                'controller_function' => 'destroy',
                'method' => 'DELETE',
                'controller_name' => 'SectionController',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}
