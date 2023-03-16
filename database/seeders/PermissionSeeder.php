<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('permissions')->insert(
            [['name' => 'user_access',],
            ['name' => 'user_create',],
            ['name' => 'user_edit',],
            ['name' => 'user_show',],
            ['name' => 'user_delete',],
            ['name' => 'permission_access',],
            ['name' => 'permission_create',],
            ['name' => 'permission_edit',],
            ['name' => 'permission_show',],
            ['name' => 'permission_delete',],
            ['name' => 'role_access',],
            ['name' => 'role_create',],
            ['name' => 'role_edit',],
            ['name' => 'role_show',],
            ['name' => 'role_delete',],
            ['name' => 'post_access',],
            ['name' => 'post_create',],
            ['name' => 'post_edit',],
            ['name' => 'post_show',],
            ['name' => 'post_delete',],
            ['name' => 'community_create',],
            ['name' => 'community_edit',],
            ['name' => 'community_show',],
            ['name' => 'community_delete',],
            ['name' => 'community_access',],
            ['name' => 'friend_create',],
            ['name' => 'friend_edit',],
            ['name' => 'friend_show',],
            ['name' => 'friend_delete',],
            ['name' => 'friend_access',],
            ['name' => 'comment_create',],
            ['name' => 'comment_edit',],
            ['name' => 'comment_show',],
            ['name' => 'comment_delete',],
            ['name' => 'comment_access',],]
        );
    }
}
