<?php

namespace App\Policies;

use App\User;
use App\Subdomain;
use Illuminate\Auth\Access\HandlesAuthorization;

class SubdomainPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the subdomain.
     *
     * @param  \App\User  $user
     * @param  \App\Subdomain  $subdomain
     * @return mixed
     */
    public function view(User $user, Subdomain $subdomain)
    {
        if ($user->institution_id === $subdomain->institution_id || $user->isSuperView()) {
            return true;
        }
    }

    /**
     * Determine whether the user can create subdomains.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the subdomain.
     *
     * @param  \App\User  $user
     * @param  \App\Subdomain  $subdomain
     * @return mixed
     */
    public function update(User $user, Subdomain $subdomain)
    {
        return $user->institution_id === $subdomain->institution_id;
    }

    /**
     * Determine whether the user can delete the subdomain.
     *
     * @param  \App\User  $user
     * @param  \App\Subdomain  $subdomain
     * @return mixed
     */
    public function delete(User $user, Subdomain $subdomain)
    {
        return $user->institution_id === $subdomain->institution_id;
    }
}
