<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ip_address extends Model
{

    use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    public function subdomains()
    {
        return $this->hasMany('App\Subdomain');
    }

    public function institution()
    {
        return $this->belongsTo('App\Institution');
    }


}
