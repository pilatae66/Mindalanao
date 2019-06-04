<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $guarded = [];

    public function setActivityNameAttribute($value)
    {
        return $this->attributes['activity_name'] = ucfirst($value);
    }

    public function setActivityVenueAttribute($value)
    {
        return $this->attributes['activity_venue'] = ucfirst($value);
    }

    public function setActivityDescriptionAttribute($value)
    {
        return $this->attributes['activity_description'] = ucfirst($value);
    }

    public function setActivityDateAttribute($value)
    {
        return $this->attributes['activity_date'] = ucfirst($value);
    }

    public function setActivityTimeAttribute($value)
    {
        return $this->attributes['activity_time'] = ucfirst($value);
    }

    public function setActivityProviderAttribute($value)
    {
        return $this->attributes['activity_provider'] = ucfirst($value);
    }
}
