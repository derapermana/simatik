<?php

namespace App\Policies;

use App\Ip_address;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class IpAddressPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the ipAddress.
     *
     * @param  \App\User  $user
     * @param  \App\IpAddress  $ipAddress
     * @return mixed
     */
    public function view(User $user, Ip_address $ip_address)
    {
        return $user->institution_id === $ip_address->institution_id;
    }

    /**
     * Determine whether the user can create ipAddresses.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the ipAddress.
     *
     * @param  \App\User  $user
     * @param  \App\IpAddress  $ipAddress
     * @return mixed
     */
    public function update(User $user, Ip_address $ip_address)
    {
        return $user->institution_id === $ip_address->institution_id;
    }

    /**
     * Determine whether the user can delete the ipAddress.
     *
     * @param  \App\User  $user
     * @param  \App\IpAddress  $ipAddress
     * @return mixed
     */
    public function delete(User $user, Ip_address $ipAddress)
    {
        return $user->institution_id === $ipAddress->institution_id;
    }
}
