<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Compensation extends Model
{
    protected $fillable = ['name', 'amount'];

    public function setNameAttribute($value)
    {
        return $this->attributes['name'] = ucfirst($value);
    }
}
