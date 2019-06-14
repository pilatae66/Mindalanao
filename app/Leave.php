<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Leave extends Model
{
    protected $fillable = ['type', 'reason', 'start_date', 'end_date', 'employee_id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'employee_id', 'id');
    }

    public function setTypeAttribute($value)
    {
        return $this->attributes['type'] = ucwords($value);
    }
}
