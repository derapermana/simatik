<?php

namespace App\Policies;

use App\User;
use App\License;
use Illuminate\Auth\Access\HandlesAuthorization;

class LicensePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the license.
     *
     * @param  \App\User  $user
     * @param  \App\License  $license
     * @return mixed
     */
    public function view(User $user, License $license)
    {
        if ($user->institution_id === $license->institution_id || $user->isSuperView())
        {
            return true;
        }

    }

    /**
     * Determine whether the user can create licenses.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the license.
     *
     * @param  \App\User  $user
     * @param  \App\License  $license
     * @return mixed
     */
    public function update(User $user, License $license)
    {
        return $user->institution_id === $license->institution_id;
    }

    /**
     * Determine whether the user can delete the license.
     *
     * @param  \App\User  $user
     * @param  \App\License  $license
     * @return mixed
     */
    public function delete(User $user, License $license)
    {
        return $user->institution_id === $license->institution_id;
    }
}
