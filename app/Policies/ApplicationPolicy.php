<?php

namespace App\Policies;

use App\User;
use App\Application;
use Illuminate\Auth\Access\HandlesAuthorization;

class ApplicationPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the application.
     *
     * @param  \App\User  $user
     * @param  \App\Application  $application
     * @return mixed
     */
    public function view(User $user, Application $application)
    {
        if ($user->institution_id === $application->institution_id || $user->isSuperView()) {
            return true;
        }
    }

    /**
     * Determine whether the user can create applications.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the application.
     *
     * @param  \App\User  $user
     * @param  \App\Application  $application
     * @return mixed
     */
    public function update(User $user, Application $application)
    {
        return $user->institution_id === $application->institution_id;
    }

    /**
     * Determine whether the user can delete the application.
     *
     * @param  \App\User  $user
     * @param  \App\Application  $application
     * @return mixed
     */
    public function delete(User $user, Application $application)
    {
        return $user->institution_id === $application->institution_id;
    }
}
