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
        DB::table('permissions')->insert([
            ['name' => 'role.create', 'description' => 'create new role'],
            ['name' => 'role.access', 'description' => 'access role'],
            ['name' => 'role.update', 'description' => 'update role'],
            ['name' => 'role.delete', 'description' => 'delete role'],
            ['name' => 'user.create', 'description' => 'create new user'],
            ['name' => 'user.access', 'description' => 'access user'],
            ['name' => 'user.update', 'description' => 'update user'],
            ['name' => 'user.delete', 'description' => 'delete user'],
            ['name' => 'post.create', 'description' => 'create new post'],
            ['name' => 'post.access', 'description' => 'access post'],
            ['name' => 'post.update', 'description' => 'update post'],
            ['name' => 'post.delete', 'description' => 'delete post'],
            ['name' => 'permission.create', 'description' => 'create new permission'],
            ['name' => 'permission.access', 'description' => 'access permission'],
            ['name' => 'permission.update', 'description' => 'update permission'],
            ['name' => 'permission.delete', 'description' => 'delete permission'],
        ]);
    }
}
