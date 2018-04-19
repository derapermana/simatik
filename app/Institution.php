<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Auth;

class Institution extends Model
{
    use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    public function parent()
    {
        return $this->belongsTo('App\Institution', 'parent_id');
    }

    public function children()
    {
        return $this->hasMany('App\Institution', 'parent_id', 'id');
    }

    public function users()
    {
        return $this->hasMany('App\User');
    }

    public function people()
    {
        return $this->hasMany('App\Person');
    }

    public function licenses()
    {
        return $this->hasMany('App\License');
    }

    public function subdomains()
    {
        return $this->hasMany('App\Subdomain');
    }

    public function ip_addresses()
    {
        return $this->hasMany('App\Ip_address');
    }

    public function applications()
    {
        return $this->hasMany('App\Application');
    }

    public function servers()
    {
        return $this->hasMany('App\Server');
    }

    private static function scopeCompanyablesDirectly($query, $column = 'institution_id')
    {
        if (Auth::user()) {
            $institution_id = Auth::user()->institution_id;
        } else {
            $institution_id = null;
        }

        return $query->where($column, '=', $institution_id);
    }

    public static function scopeCompanyables($query, $column = 'institution_id')
    {
        // If not logged in and hitting this, assume we are on the command line and don't scope?'
        if ((Auth::check() && Auth::user()->isSuperUser()) || (Auth::check() && Auth::user()->isSuperView()) || (!Auth::check())) {
            return $query;
        } else {
            return static::scopeCompanyablesDirectly($query, $column);
        }
    }

    public static function getIdForCurrentUser($unescaped_input)
    {
        $current_user = Auth::user();

        // Super users should be able to set a company to whatever they need
        if ($current_user->isSuperUser()) {
            return static::getIdFromInput($unescaped_input);
        } else {
            if ($current_user->institution_id != null) {
                return $current_user->institution_id;
            } else {
                return static::getIdFromInput($unescaped_input);
            }
        }
    }

    public static function getIdFromInput($unescaped_input)
    {
        $escaped_input = e($unescaped_input);

        if ($escaped_input == '0') {
            return null;
        } else {
            return $escaped_input;
        }
    }

    public static function isCurrentUserAuthorized()
    {

        return ((Auth::user()->isSuperUser()) || Auth::user()->hasAccess('superview'));
    }

}
