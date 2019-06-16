<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Leave extends Model
{
    protected $fillable = ['leave_type_id', 'reason', 'start_date', 'end_date', 'employee_id', 'admin_id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'employee_id', 'id');
    }

    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id', 'id');
    }

    public function type()
    {
        return $this->belongsTo(LeaveType::class, 'leave_type_id', 'id');
    }

    public function setReasonAttribute($value)
    {
        return $this->attributes['reason'] = ucwords($value);
    }
}
