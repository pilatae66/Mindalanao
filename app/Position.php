<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    protected $fillable = ['position', 'salary'];

    public function setPositionAttribute($value)
    {
        $this->attributes['position'] = ucfirst($value);
    }

    public function department()
    {
        return $this->belongsToMany(Department::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
