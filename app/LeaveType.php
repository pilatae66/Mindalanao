<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LeaveType extends Model
{
    protected $fillable = ['name', 'days_allowed'];

    public function leaves()
    {
        return $this->hasMany(Leave::class);
    }
}
