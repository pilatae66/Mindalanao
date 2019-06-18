<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Leave extends Model
{
    protected $fillable = ['leave_type_id', 'reason', 'start_date', 'end_date', 'employee_id', 'admin_id'];

    protected static function boot() {
        parent::boot();

        static::saving(function($model){
            $model->number_of_days = Carbon::parse($model->start_date)->diffInDays(Carbon::parse($model->end_date));
        });

        static::updating(function($model){
            $model->number_of_days = Carbon::parse($model->start_date)->diffInDays(Carbon::parse($model->end_date));
        });
    }

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
