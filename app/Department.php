<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $fillable = ['department_name', 'parent_department_id'];

    public function setDepartmentNameAttribute($value)
    {
        return $this->attributes['department_name'] = ucfirst($value);
    }

    public function employee()
    {
        return $this->belongsToMany(User::class);
    }

    public function parent()
    {
        return $this->hasOne(Department::class, 'id', 'parent_department_id');
    }
}
