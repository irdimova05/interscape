<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\Ad;
use App\Models\Apply;
use App\Models\Employer;
use App\Models\Favorite;
use App\Models\ReportedAd;
use App\Models\Student;
use App\Models\User;
use App\Policies\AdPolicy;
use App\Policies\ApplyPolicy;
use App\Policies\EmployerPolicy;
use App\Policies\FavoritesPolicy;
use App\Policies\InterestsPolicy;
use App\Policies\ReportedAdPolicy;
use App\Policies\StudentPolicy;
use App\Policies\UserPolicy;
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
        Apply::class => ApplyPolicy::class,
        Employer::class => EmployerPolicy::class,
        Favorite::class => FavoritesPolicy::class,
        Student::class => StudentPolicy::class,
        User::class => UserPolicy::class,
        ReportedAd::class => ReportedAdPolicy::class,
        InterestsPolicy::class => InterestsPolicy::class,
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
        Gate::define('ad.view', [AdPolicy::class, 'view']);
        Gate::define('create.ad', [AdPolicy::class, 'create']);
        Gate::define('edit.ad', [AdPolicy::class, 'update']);
        Gate::define('status.ad', [AdPolicy::class, 'status']);
        Gate::define('report.ad', [AdPolicy::class, 'report']);
        Gate::define('block.ad', [AdPolicy::class, 'block']);

        Gate::define('list.applies', [ApplyPolicy::class, 'viewAny']);
        Gate::define('show.apply', [ApplyPolicy::class, 'view']);
        Gate::define('apply.ad', [ApplyPolicy::class, 'create']);
        Gate::define('approve.apply', [ApplyPolicy::class, 'approve']);
        Gate::define('reject.apply', [ApplyPolicy::class, 'reject']);

        Gate::define('list.employers', [EmployerPolicy::class, 'viewAny']);
        Gate::define('show.employer', [EmployerPolicy::class, 'view']);
        Gate::define('interest.employer', [EmployerPolicy::class, 'interestToStudent']);

        Gate::define('list.student', [StudentPolicy::class, 'viewAny']);
        Gate::define('show.student', [StudentPolicy::class, 'view']);
        Gate::define('interest.student', [StudentPolicy::class, 'interestToEmployer']);

        Gate::define('list.users', [UserPolicy::class, 'viewAny']);
        Gate::define('show.user', [UserPolicy::class, 'view']);
        Gate::define('create.user', [UserPolicy::class, 'create']);
        Gate::define('edit.user', [UserPolicy::class, 'update']);
        Gate::define('status.user', [UserPolicy::class, 'status']);

        Gate::define('list.favorites', [FavoritesPolicy::class, 'viewAny']);
        Gate::define('add.favorites', [FavoritesPolicy::class, 'create']);
        Gate::define('remove.favorites', [FavoritesPolicy::class, 'delete']);

        Gate::define('list.reports', [ReportedAdPolicy::class, 'viewAny']);
        Gate::define('show.report', [ReportedAdPolicy::class, 'view']);
        Gate::define('status.report', [ReportedAdPolicy::class, 'update']);

        Gate::define('list.interests', [InterestsPolicy::class, 'viewAny']);
        Gate::define('create.interests', [InterestsPolicy::class, 'create']);
    }
}
