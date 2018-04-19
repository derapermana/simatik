<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Activitylog\Traits\LogsActivity;

class User extends Authenticatable
{
    use Notifiable;
    use LogsActivity;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected static $ignoreChangedAttributes = ['lastlogin', 'updated_at'];
    protected $fillable = [
        'name', 'email', 'password', 'institution_id', 'isactive', 'lastlogin',
        'permissions'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    protected static $logOnlyDirty = true;

    public function groups()
    {
        return $this->belongsToMany('\App\Group', 'users_groups');
    }

    public function institution()
    {
        return $this->belongsTo('App\Institution');
    }

    public function hasAccess($section)
    {

        if ($this->isSuperUser()) {
            return true;
        }

        $user_groups = $this->groups;


        if (($this->permissions=='')  && (count($user_groups) == 0)) {
            return false;
        }

        $user_permissions = json_decode($this->permissions, true);

        //If the user is explicitly granted, return true
        if (($user_permissions!='') && ((array_key_exists($section, $user_permissions)) && ($user_permissions[$section]=='1'))) {
            return true;
        }

        // If the user is explicitly denied, return false
        if (($user_permissions=='') || array_key_exists($section, $user_permissions) && ($user_permissions[$section]=='-1')) {
            return false;
        }

        // Loop through the groups to see if any of them grant this permission
        foreach ($user_groups as $user_group) {
            $group_permissions = (array) json_decode($user_group->permissions, true);
            if (((array_key_exists($section, $group_permissions)) && ($group_permissions[$section]=='1'))) {
                return true;
            }
        }

        return false;
    }

    public function isSuperUser()
    {
        if (!$user_permissions = json_decode($this->permissions, true)) {
            return false;
        }

        foreach ($this->groups as $user_group) {
            $group_permissions = json_decode($user_group->permissions, true);
            $group_array = (array)$group_permissions;
            if ((array_key_exists('superuser', $group_array)) && ($group_permissions['superuser']=='1')) {
                return true;
            }
        }

        if ((array_key_exists('superuser', $user_permissions)) && ($user_permissions['superuser']=='1')) {
            return true;
        }

        return false;
    }

    public function isSuperView()
    {
        if (!$user_permissions = json_decode($this->permissions, true)) {
            return false;
        }

        foreach ($this->groups as $user_group) {
            $group_permissions = json_decode($user_group->permissions, true);
            $group_array = (array)$group_permissions;
            if ((array_key_exists('superview', $group_array)) && ($group_permissions['superview']=='1')) {
                return true;
            }
        }

        if ((array_key_exists('superview', $user_permissions)) && ($user_permissions['superview']=='1')) {
            return true;
        }

        return false;
    }

    public function decodePermissions()
    {
        return json_decode($this->permissions, true);
    }
}
