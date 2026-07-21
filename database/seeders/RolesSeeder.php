<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class RolesSeeder extends Seeder
{
    // Grouping permissions
    protected array $permissions = [
        'Users' => [
            'resource' => 'User',
            'actions'  => [
                'viewAny', 'view', 'create', 'update', 'delete', 'deleteAny', 'restore', 'restoreAny', 'forceDelete', 'forceDeleteAny',
            ],
        ],
        'Roles' => [
            'resource' => 'Roles',
            'actions'  => [
                'viewAny', 'view', 'create', 'update', 'delete', 'deleteAny', 'restore', 'restoreAny', 'forceDelete', 'forceDeleteAny',
            ],
        ],
        'Permissions' => [
            'resource' => 'Permissions',
            'actions'  => [
                'viewAny',
            ],
        ],
        // tambah group lain di sini
    ];

    // Role dan akses yang diizinkan per action
    protected array $roles = [
        'superadmin' => '*',
        // 'admin' => [
        //     'viewAny', 'view', 'create', 'update', 'delete', 'deleteAny',
        // ],
    ];

    public function run(): void
    {
        // 1. Buat permissions (group) + action resources
        $permissionIds = []; // ['user-management' => uuid]
        $actionResourceIds = []; // ['viewAny.user' => uuid]

        foreach ($this->permissions as $groupName => $config) {
            // Insert group ke tabel permissions
            DB::table('permissions')->insertOrIgnore([
                'id'         => (string) Str::uuid(),
                'name'       => $groupName,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            $permissionId = DB::table('permissions')
                ->where('name', $groupName)
                ->value('id');

            $permissionIds[$groupName] = $permissionId;

            // Insert tiap action ke permission_action_resources
            foreach ($config['actions'] as $action) {
                $key = "{$action}.{$config['resource']}";

                DB::table('permission_action_resources')->insertOrIgnore([
                    'id'         => (string) Str::uuid(),
                    'permission_id' => $permissionId,
                    'action'     => $action,
                    'resource'   => $config['resource'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                $actionResourceIds[$key] = DB::table('permission_action_resources')
                    ->where('permission_id', $permissionId)
                    ->where('action', $action)
                    ->where('resource', $config['resource'])
                    ->value('id');
            }
        }

        // 2. Buat roles
        foreach ($this->roles as $slug => $allowedActions) {
            $name = ucfirst(str_replace('-', ' ', $slug));

            DB::table('roles')->insertOrIgnore([
                'id'         => (string) Str::uuid(),
                'name'       => $name,
                'slug'       => $slug,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            $roleId = DB::table('roles')->where('slug', $slug)->value('id');

            // Assign permission_action_resources ke role
            foreach ($this->permissions as $groupName => $config) {

                foreach ($config['actions'] as $action) {

                    $shouldAssign = $allowedActions === '*'
                        || in_array($action, $allowedActions);

                    if (! $shouldAssign) {
                        continue;
                    }

                    $permissionActionResourceId = DB::table('permission_action_resources')
                        ->where('permission_id', $permissionIds[$groupName])
                        ->where('action', $action)
                        ->where('resource', $config['resource'])
                        ->value('id');

                    if (! $permissionActionResourceId) {
                        continue;
                    }

                    DB::table('role_permissions')->insertOrIgnore([
                        'role_id' => $roleId,
                        'permission_action_resource_id' => $permissionActionResourceId,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }
        }
    }
}
