<?php

namespace App\Providers;

use App\Models\Permission;
use App\User;
use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any application authentication / authorization services.
     *
     * @param  \Illuminate\Contracts\Auth\Access\Gate  $gate
     * @return void
     */
    public function boot(GateContract $gate)
    {
        $this->registerPolicies($gate);

        try {
            foreach ($this->getPermissions() as $permission) {
                $gate->define($permission->name, function (User $user) use ($permission) {
                    return $user->hasRole($permission->roles());
                });
            }
        } catch (QueryException $e) {
            if (app()->environment('local')) {
                echo "Permissions system not work properly, because database not setup correctly. ".PHP_EOL;
                echo "Maybe you have forgot to run the migration command, unless you're now doing this.". PHP_EOL;
                echo "Ignored.". PHP_EOL;
            }
        }
    }

    protected function getPermissions()
    {
        return Permission::with('roles')->get();
    }
}
