<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            [
                'id'    => 1,
                'title' => 'user_management_access',
            ],
            [
                'id'    => 2,
                'title' => 'permission_create',
            ],
            [
                'id'    => 3,
                'title' => 'permission_edit',
            ],
            [
                'id'    => 4,
                'title' => 'permission_show',
            ],
            [
                'id'    => 5,
                'title' => 'permission_delete',
            ],
            [
                'id'    => 6,
                'title' => 'permission_access',
            ],
            [
                'id'    => 7,
                'title' => 'role_create',
            ],
            [
                'id'    => 8,
                'title' => 'role_edit',
            ],
            [
                'id'    => 9,
                'title' => 'role_show',
            ],
            [
                'id'    => 10,
                'title' => 'role_delete',
            ],
            [
                'id'    => 11,
                'title' => 'role_access',
            ],
            [
                'id'    => 12,
                'title' => 'user_create',
            ],
            [
                'id'    => 13,
                'title' => 'user_edit',
            ],
            [
                'id'    => 14,
                'title' => 'user_show',
            ],
            [
                'id'    => 15,
                'title' => 'user_delete',
            ],
            [
                'id'    => 16,
                'title' => 'user_access',
            ],
            [
                'id'    => 17,
                'title' => 'alltype_access',
            ],
            [
                'id'    => 18,
                'title' => 'language_create',
            ],
            [
                'id'    => 19,
                'title' => 'language_edit',
            ],
            [
                'id'    => 20,
                'title' => 'language_show',
            ],
            [
                'id'    => 21,
                'title' => 'language_delete',
            ],
            [
                'id'    => 22,
                'title' => 'language_access',
            ],
            [
                'id'    => 23,
                'title' => 'author_create',
            ],
            [
                'id'    => 24,
                'title' => 'author_edit',
            ],
            [
                'id'    => 25,
                'title' => 'author_show',
            ],
            [
                'id'    => 26,
                'title' => 'author_delete',
            ],
            [
                'id'    => 27,
                'title' => 'author_access',
            ],
            [
                'id'    => 28,
                'title' => 'aarsh_kosh_access',
            ],
            [
                'id'    => 29,
                'title' => 'aarshbook_create',
            ],
            [
                'id'    => 30,
                'title' => 'aarshbook_edit',
            ],
            [
                'id'    => 31,
                'title' => 'aarshbook_show',
            ],
            [
                'id'    => 32,
                'title' => 'aarshbook_delete',
            ],
            [
                'id'    => 33,
                'title' => 'aarshbook_access',
            ],
            [
                'id'    => 34,
                'title' => 'aarshgranth_create',
            ],
            [
                'id'    => 35,
                'title' => 'aarshgranth_edit',
            ],
            [
                'id'    => 36,
                'title' => 'aarshgranth_show',
            ],
            [
                'id'    => 37,
                'title' => 'aarshgranth_delete',
            ],
            [
                'id'    => 38,
                'title' => 'aarshgranth_access',
            ],
            [
                'id'    => 39,
                'title' => 'aarshchapter_create',
            ],
            [
                'id'    => 40,
                'title' => 'aarshchapter_edit',
            ],
            [
                'id'    => 41,
                'title' => 'aarshchapter_show',
            ],
            [
                'id'    => 42,
                'title' => 'aarshchapter_delete',
            ],
            [
                'id'    => 43,
                'title' => 'aarshchapter_access',
            ],
            [
                'id'    => 44,
                'title' => 'aarsh_desc_create',
            ],
            [
                'id'    => 45,
                'title' => 'aarsh_desc_edit',
            ],
            [
                'id'    => 46,
                'title' => 'aarsh_desc_show',
            ],
            [
                'id'    => 47,
                'title' => 'aarsh_desc_delete',
            ],
            [
                'id'    => 48,
                'title' => 'aarsh_desc_access',
            ],
            [
                'id'    => 49,
                'title' => 'profile_password_edit',
            ],
        ];

        Permission::insert($permissions);
    }
}
