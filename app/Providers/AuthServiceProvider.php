<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\Ad;
use App\Policies\AdPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Ad::class => AdPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        $this->registerGates();
    }

    /**
     * Register gates.
     *
     * @return void
     */
    public function registerGates()
    {
        Gate::define('list.ad', [AdPolicy::class, 'viewAny']);
        Gate::define('show.ad', [AdPolicy::class, 'view']);
        Gate::define('create.ad', [AdPolicy::class, 'create']);
        Gate::define('edit.ad', [AdPolicy::class, 'update']);
        Gate::define('status.ad', [AdPolicy::class, 'status']);
        Gate::define('report.ad', [AdPolicy::class, 'report']);

        Gate::define('list.applies', [ApplyPolicy::class, 'viewAny']);
        Gate::define('show.apply', [ApplyPolicy::class, 'view']);
        Gate::define('apply.ad', [ApplyPolicy::class, 'create']);
        Gate::define('status.apply', [ApplyPolicy::class, 'update']);

        Gate::define('list.employer', [EmployerPolicy::class, 'viewAny']);
        Gate::define('show.employer', [EmployerPolicy::class, 'view']);

        Gate::define('list.favorites', [FavoritesPolicy::class, 'viewAny']);
        Gate::define('add.favorites', [FavoritesPolicy::class, 'create']);
        Gate::define('remove.favorites', [FavoritesPolicy::class, 'delete']);
    }
}
