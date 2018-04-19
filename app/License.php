<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class License extends Model
{
    use SoftDeletes;
    use LogsActivity;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];
    protected static $ignoreChangedAttributes = ['updated_at'];
    protected static $logAttributes = ['*'];
    protected static $logOnlyDirty = true;
    
    public function institution()
    {
        return $this->belongsTo('App\Institution');
    }

    public function person()
    {
        return $this->belongsTo('App\Person');
    }

}
