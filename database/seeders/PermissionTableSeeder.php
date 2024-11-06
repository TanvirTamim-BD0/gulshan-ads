<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   
        $permissions = [

            [
              'permissions' => [
                'balance-top-up',
              ]
            ],

            [
              'permissions' => [
                 'meta-ad-accounts',
              ]
            ],

            [
              'permissions' => [
                 'top-up-limit-request',
              ]
            ],


            [
              'permissions' => [
                 'campaign',
              ]
            ],

            [
              'permissions' => [
                 'services',
              ]
            ],

            [
              'permissions' => [
                 'users',
              ]
            ],

            [
              'permissions' => [
                 'admin',
              ]
            ],

            [
              'permissions' => [
                 'role',
              ]
            ],

            [
              'permissions' => [
                 'payment-method',
              ]
            ],

            [
              'permissions' => [
                 'reports',
              ]
            ],

            [
              'permissions' => [
                 'guides',
              ]
            ],

            [
              'permissions' => [
                'support',
              ]
            ],

            [
              'permissions' => [
                'ads',
              ]
            ],

        ];


         // Create Permissions
        for ($i = 0; $i < count($permissions); $i++) {
            for ($j = 0; $j < count($permissions[$i]['permissions']); $j++) {
                // Create Permission
                $permission = Permission::create(['name' => $permissions[$i]['permissions'][$j], 'guard_name' => 'admin']);
            }
        }
    }
}
