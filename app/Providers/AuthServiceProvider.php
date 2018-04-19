<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\IpAddress;
use App\User;
use App\Person;
use App\Subdomain;
use App\License;
use App\Application;
use App\Server;
use App\Policies\IpAddressPolicy;
use App\Policies\PersonPolicy;
use App\Policies\SubdomainPolicy;
use App\Policies\LicensePolicy;
use App\Policies\ApplicationPolicy;
use App\Policies\UserPolicy;
use App\Policies\ServerPolicy;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
        IpAddress::class => IpAddressPolicy::class,
        Person::class => PersonPolicy::class,
        Subdomain::class => SubdomainPolicy::class,
        License::class => LicensePolicy::class,
        Application::class => ApplicationPolicy::class,
        User::class => UserPolicy::class,
        Server::class => ServerPolicy::class,

    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::before(function ($user) {
            if ($user->isSuperUser()) {
                return true;
            }
        });

        Gate::define('admin', function($user) {
            if ($user->hasAccess('admin')) {
                return true;
            }
        });

        Gate::define('superview', function($user) {
            return true;
        });

        //Gate Users
        Gate::define('user.b', function($user) {
            if ($user->hasAccess('user.b')) {
                return true;
            }
        });

        Gate::define('user.r', function($user) {
            if ($user->hasAccess('user.r')) {
                return true;
            }
        });

        Gate::define('user.e', function($user) {
            if ($user->hasAccess('user.e')) {
                return true;
            }
        });

        Gate::define('user.a', function($user) {
            if ($user->hasAccess('user.a')) {
                return true;
            }
        });

        Gate::define('user.d', function($user) {
            if ($user->hasAccess('user.d')) {
                return true;
            }
        });

        //Gate Persons
        Gate::define('person.b', function($user) {
            if ($user->hasAccess('person.b') || $user->hasAccess('admin') || $user->hasAccess('superview')) {
                return true;
            }
        });

        Gate::define('person.r', function($user) {
            if ($user->hasAccess('person.r') || $user->hasAccess('admin') || $user->hasAccess('superview')) {
                return true;
            }
        });

        Gate::define('person.e', function($user) {
            if ($user->hasAccess('person.e') || $user->hasAccess('admin')) {
                return true;
            }
        });

        Gate::define('person.a', function($user) {
            if ($user->hasAccess('person.a') || $user->hasAccess('admin')) {
                return true;
            }
        });

        Gate::define('person.d', function($user) {
            if ($user->hasAccess('person.d') || $user->hasAccess('admin')) {
                return true;
            }
        });

        //Gate Licenses
        Gate::define('license.b', function($user) {
            if ($user->hasAccess('license.b') || $user->hasAccess('admin') || $user->hasAccess('superview')) {
                return true;
            }
        });

        Gate::define('license.r', function($user) {
            if ($user->hasAccess('license.r') || $user->hasAccess('admin') || $user->hasAccess('superview')) {
                return true;
            }
        });

        Gate::define('license.e', function($user) {
            if ($user->hasAccess('license.e') || $user->hasAccess('admin')) {
                return true;
            }
        });

        Gate::define('license.a', function($user) {
            if ($user->hasAccess('license.a') || $user->hasAccess('admin')) {
                return true;
            }
        });

        Gate::define('license.d', function($user) {
            if ($user->hasAccess('license.d') || $user->hasAccess('admin')) {
                return true;
            }
        });

        //Gate Subdomain
        Gate::define('subdomain.b', function($user) {
            if ($user->hasAccess('subdomain.b') || $user->hasAccess('admin') || $user->hasAccess('superview')) {
                return true;
            }
        });

        Gate::define('subdomain.r', function($user) {
            if ($user->hasAccess('subdomain.r') || $user->hasAccess('admin') || $user->hasAccess('superview')) {
                return true;
            }
        });

        Gate::define('subdomain.e', function($user) {
            if ($user->hasAccess('subdomain.e') || $user->hasAccess('admin')) {
                return true;
            }
        });

        Gate::define('subdomain.a', function($user) {
            if ($user->hasAccess('subdomain.a') || $user->hasAccess('admin')) {
                return true;
            }
        });

        Gate::define('subdomain.d', function($user) {
            if ($user->hasAccess('subdomain.d') || $user->hasAccess('admin')) {
                return true;
            }
        });

        //Gate IP Address
        Gate::define('ip_address.b', function($user) {
            if ($user->hasAccess('ip_address.b')) {
                return true;
            }
        });

        Gate::define('ip_address.r', function($user) {
            if ($user->hasAccess('ip_address.r')) {
                return true;
            }
        });

        Gate::define('ip_address.e', function($user) {
            if ($user->hasAccess('ip_address.e')) {
                return true;
            }
        });

        Gate::define('ip_address.a', function($user) {
            if ($user->hasAccess('ip_address.a')) {
                return true;
            }
        });

        Gate::define('ip_address.d', function($user) {
            if ($user->hasAccess('ip_address.d')) {
                return true;
            }
        });

        //Gate Application
        Gate::define('application.b', function($user) {
            if ($user->hasAccess('application.b') || $user->hasAccess('admin') || $user->hasAccess('superview')) {
                return true;
            }
        });

        Gate::define('application.r', function($user) {
            if ($user->hasAccess('application.r') || $user->hasAccess('admin') || $user->hasAccess('superview')) {
                return true;
            }
        });

        Gate::define('application.e', function($user) {
            if ($user->hasAccess('application.e') || $user->hasAccess('admin')) {
                return true;
            }
        });

        Gate::define('application.a', function($user) {
            if ($user->hasAccess('application.a') || $user->hasAccess('admin')) {
                return true;
            }
        });

        Gate::define('application.d', function($user) {
            if ($user->hasAccess('application.d') || $user->hasAccess('admin')) {
                return true;
            }
        });

        //Gate Servers
        Gate::define('server.b', function($user) {
            if ($user->hasAccess('server.b') || $user->hasAccess('admin') || $user->hasAccess('superview')) {
                return true;
            }
        });

        Gate::define('server.r', function($user) {
            if ($user->hasAccess('server.r') || $user->hasAccess('admin') || $user->hasAccess('superview')) {
                return true;
            }
        });

        Gate::define('server.e', function($user) {
            if ($user->hasAccess('server.e') || $user->hasAccess('admin')) {
                return true;
            }
        });

        Gate::define('server.a', function($user) {
            if ($user->hasAccess('server.a') || $user->hasAccess('admin')) {
                return true;
            }
        });

        Gate::define('server.d', function($user) {
            if ($user->hasAccess('server.d') || $user->hasAccess('admin')) {
                return true;
            }
        });


    }
}
