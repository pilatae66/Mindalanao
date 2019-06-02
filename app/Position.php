<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    protected $fillable = ['position'];

    public function setPositionAttribute($value)
    {
        $this->attributes['position'] = ucfirst($value);
    }
}
