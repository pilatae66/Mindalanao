<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $fillable = ['department_name'];

    public function setDepartmentNameAttribute($value)
    {
        return $this->attributes['department_name'] = ucfirst($value);
    }

    public function employee()
    {
        return $this->belongsToMany(User::class);
    }
}
