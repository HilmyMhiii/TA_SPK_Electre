<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    public static array $permissionRole = [
        'dashboard' => ['admin', 'user'],
        'user' => ['user'],
        'admin' => ['admin'],
    ];

    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        $this->definePermissions(self::$permissionRole, 'role');
    }

    /**
     * Define permissions based on roles or sub-roles.
     *
     * @param array $permissions
     * @param string $attribute
     */
    private function definePermissions(array $permissions, string $attribute): void
    {
        foreach ($permissions as $permission => $roles) {
            foreach ($roles as $role) {
                Gate::define($permission, function (User $user) use ($role) {
                    return $user->role === $role;
                });
            }
        }
    }
}
