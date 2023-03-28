<?php

namespace App\Providers;

use App\Models\Permission;
use App\Models\Post;
use App\Models\Role;
use App\Models\User;
use App\Policies\PermissionPolicy;
use App\Policies\UserPolicy;
use App\Policies\PostPolicy;
use App\Policies\RolePolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
        User::class => UserPolicy::class,
        Post::class => PostPolicy::class,
        Role::class => RolePolicy::class,
        Permission::class => PermissionPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();
    }

}
