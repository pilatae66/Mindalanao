<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use QrCode;
use DB;
use Carbon\Carbon;

class User extends Authenticatable
{
    use Notifiable;

    protected static function boot() {
        parent::boot();

        static::saving(function($model){
            $model->QRCodeURL = "storage/{$model->full_name}.png";
        });

        static::saved(function($model){
            QrCode::size(720)
                ->format('png')
                ->generate($model->id, public_path("storage/{$model->full_name}.png"));
        });
    }

    public function dtrDataEmployee($month, $year, $day)
    {
        $dtr = [];
        $offset = 0;
        $offset2 = 0;
        if ($day > 15) {
            if (Carbon::createFromDate($year, $month, $day)->daysInMonth > 30) {
                # code...
                $offset = Carbon::createFromDate($year, $month, $day)->daysInMonth - 16;
                $offset2 = $offset + 1;
            }else{
                $offset = Carbon::createFromDate($year, $month, $day)->daysInMonth - 15;
                $offset2 = $offset;
            }
        }
        $hrsPerDay = 8;

        for ($i=1+$offset; $i <= 15+$offset2; $i++) {
            $day = $i;
            $dtr[$i]['day'] = Carbon::createFromDate($year, $month, $day)->format('m/d');
            $morning_in = $this->attendances()->whereMonth('created_at', $month)->whereYear('created_at', $year)->whereDay('created_at', $i)->where('type', 'In')->whereTime('created_at', '>=', '08:00:00')->whereTime('created_at', '<=', '12::00')->first();
            $dtr[$i]['Morning In'] = $morning_in != null > 0 ? $morning_in->created_at->format('g:i A') : '-';
            $morning_out = $this->attendances()->whereMonth('created_at', $month)->whereYear('created_at', $year)->whereDay('created_at', $i)->where('type', 'Out')->whereTime('created_at', '>=', '08:00:00')->whereTime('created_at', '<=', '12::00')->first();
            $dtr[$i]['Morning Out'] = $morning_out != null > 0 ? $morning_out->created_at->format('g:i A') : '-';
            $afternoon_in = $this->attendances()->whereMonth('created_at', $month)->whereYear('created_at', $year)->whereDay('created_at', $i)->where('type', 'In')->whereTime('created_at', '>=', '12:00:00')->whereTime('created_at', '<=', '18::00')->first();
            $dtr[$i]['Afternoon In'] = $afternoon_in != null > 0 ? $afternoon_in->created_at->format('g:i A') : '-';
            $afternoon_out = $this->attendances()->whereMonth('created_at', $month)->whereYear('created_at', $year)->whereDay('created_at', $i)->where('type', 'Out')->whereTime('created_at', '>=', '12:00:00')->whereTime('created_at', '<=', '18::00')->first();
            $dtr[$i]['Afternoon Out'] = $afternoon_out != null > 0 ? $afternoon_out->created_at->format('g:i A') : '-';
            $evening_in = $this->attendances()->whereMonth('created_at', $month)->whereYear('created_at', $year)->whereDay('created_at', $i)->where('type', 'In')->whereTime('created_at', '>=', '18:00:00')->whereTime('created_at', '<=', '24::00')->first();
            $dtr[$i]['Evening In'] = $evening_in != null > 0 ? $evening_in->created_at->format('g:i A') : '-';
            $evening_out = $this->attendances()->whereMonth('created_at', $month)->whereYear('created_at', $year)->whereDay('created_at', $i)->where('type', 'Out')->whereTime('created_at', '>=', '18:00:00')->whereTime('created_at', '<=', '24::00')->first();
            $dtr[$i]['Evening Out'] = $evening_out != null ? $evening_out->created_at->format('g:i A') : '-';
            if ($morning_in != null) {
                if ($morning_in->isHoliday == 1) {
                    $dtr[$i]['total_hours_in_a_day'] = 0;
                    $dtr[$i]['holiday_hours'] = ($morning_in != null && $morning_out != null ? $morning_in->created_at->diffInHours($morning_out->created_at) : 0) + ($afternoon_in != null && $afternoon_out != null ? $afternoon_in->created_at->diffInHours($afternoon_out->created_at) : 0) + ($evening_in != null && $evening_out != null ? $evening_in->created_at->diffInHours($evening_out->created_at) : 0);
                }
                else{
                    $dtr[$i]['holiday_hours'] = 0;
                    $dtr[$i]['total_hours_in_a_day'] = ($morning_in != null && $morning_out != null ? $morning_in->created_at->diffInHours($morning_out->created_at) : 0) + ($afternoon_in != null && $afternoon_out != null ? $afternoon_in->created_at->diffInHours($afternoon_out->created_at) : 0) + ($evening_in != null && $evening_out != null ? $evening_in->created_at->diffInHours($evening_out->created_at) : 0);
                }
            }
            else if ($morning_out != null) {
                if ($morning_out->isHoliday == 1) {
                    $dtr[$i]['total_hours_in_a_day'] = 0;
                    $dtr[$i]['holiday_hours'] = ($morning_in != null && $morning_out != null ? $morning_in->created_at->diffInHours($morning_out->created_at) : 0) + ($afternoon_in != null && $afternoon_out != null ? $afternoon_in->created_at->diffInHours($afternoon_out->created_at) : 0) + ($evening_in != null && $evening_out != null ? $evening_in->created_at->diffInHours($evening_out->created_at) : 0);
                }
                else{
                    $dtr[$i]['holiday_hours'] = 0;
                    $dtr[$i]['total_hours_in_a_day'] = ($morning_in != null && $morning_out != null ? $morning_in->created_at->diffInHours($morning_out->created_at) : 0) + ($afternoon_in != null && $afternoon_out != null ? $afternoon_in->created_at->diffInHours($afternoon_out->created_at) : 0) + ($evening_in != null && $evening_out != null ? $evening_in->created_at->diffInHours($evening_out->created_at) : 0);
                }
            }
            else if ($afternoon_in != null) {
                if ($afternoon_in->isHoliday == 1) {
                    $dtr[$i]['total_hours_in_a_day'] = 0;
                    $dtr[$i]['holiday_hours'] = ($morning_in != null && $morning_out != null ? $morning_in->created_at->diffInHours($morning_out->created_at) : 0) + ($afternoon_in != null && $afternoon_out != null ? $afternoon_in->created_at->diffInHours($afternoon_out->created_at) : 0) + ($evening_in != null && $evening_out != null ? $evening_in->created_at->diffInHours($evening_out->created_at) : 0);
                }
                else{
                    $dtr[$i]['holiday_hours'] = 0;
                    $dtr[$i]['total_hours_in_a_day'] = ($morning_in != null && $morning_out != null ? $morning_in->created_at->diffInHours($morning_out->created_at) : 0) + ($afternoon_in != null && $afternoon_out != null ? $afternoon_in->created_at->diffInHours($afternoon_out->created_at) : 0) + ($evening_in != null && $evening_out != null ? $evening_in->created_at->diffInHours($evening_out->created_at) : 0);
                }
            }
            else if ($afternoon_out != null) {
                if ($afternoon_out->isHoliday == 1) {
                    $dtr[$i]['total_hours_in_a_day'] = 0;
                    $dtr[$i]['holiday_hours'] = ($morning_in != null && $morning_out != null ? $morning_in->created_at->diffInHours($morning_out->created_at) : 0) + ($afternoon_in != null && $afternoon_out != null ? $afternoon_in->created_at->diffInHours($afternoon_out->created_at) : 0) + ($evening_in != null && $evening_out != null ? $evening_in->created_at->diffInHours($evening_out->created_at) : 0);
                }
                else{
                    $dtr[$i]['holiday_hours'] = 0;
                    $dtr[$i]['total_hours_in_a_day'] = ($morning_in != null && $morning_out != null ? $morning_in->created_at->diffInHours($morning_out->created_at) : 0) + ($afternoon_in != null && $afternoon_out != null ? $afternoon_in->created_at->diffInHours($afternoon_out->created_at) : 0) + ($evening_in != null && $evening_out != null ? $evening_in->created_at->diffInHours($evening_out->created_at) : 0);
                }
            }
            else if ($evening_in != null) {
                if ($evening_in->isHoliday == 1) {
                    $dtr[$i]['total_hours_in_a_day'] = 0;
                    $dtr[$i]['holiday_hours'] = ($morning_in != null && $morning_out != null ? $morning_in->created_at->diffInHours($morning_out->created_at) : 0) + ($afternoon_in != null && $afternoon_out != null ? $afternoon_in->created_at->diffInHours($afternoon_out->created_at) : 0) + ($evening_in != null && $evening_out != null ? $evening_in->created_at->diffInHours($evening_out->created_at) : 0);
                }
                else{
                    $dtr[$i]['holiday_hours'] = 0;
                    $dtr[$i]['total_hours_in_a_day'] = ($morning_in != null && $morning_out != null ? $morning_in->created_at->diffInHours($morning_out->created_at) : 0) + ($afternoon_in != null && $afternoon_out != null ? $afternoon_in->created_at->diffInHours($afternoon_out->created_at) : 0) + ($evening_in != null && $evening_out != null ? $evening_in->created_at->diffInHours($evening_out->created_at) : 0);
                }
            }
            else if ($evening_out != null) {
                if ($evening_out->isHoliday == 1) {
                    $dtr[$i]['total_hours_in_a_day'] = 0;
                    $dtr[$i]['holiday_hours'] = ($morning_in != null && $morning_out != null ? $morning_in->created_at->diffInHours($morning_out->created_at) : 0) + ($afternoon_in != null && $afternoon_out != null ? $afternoon_in->created_at->diffInHours($afternoon_out->created_at) : 0) + ($evening_in != null && $evening_out != null ? $evening_in->created_at->diffInHours($evening_out->created_at) : 0);
                }
                else{
                    $dtr[$i]['holiday_hours'] = 0;
                    $dtr[$i]['total_hours_in_a_day'] = ($morning_in != null && $morning_out != null ? $morning_in->created_at->diffInHours($morning_out->created_at) : 0) + ($afternoon_in != null && $afternoon_out != null ? $afternoon_in->created_at->diffInHours($afternoon_out->created_at) : 0) + ($evening_in != null && $evening_out != null ? $evening_in->created_at->diffInHours($evening_out->created_at) : 0);
                }
            }
            else{
                $dtr[$i]['holiday_hours'] = 0;
                $dtr[$i]['total_hours_in_a_day'] = ($morning_in != null && $morning_out != null ? $morning_in->created_at->diffInHours($morning_out->created_at) : 0) + ($afternoon_in != null && $afternoon_out != null ? $afternoon_in->created_at->diffInHours($afternoon_out->created_at) : 0) + ($evening_in != null && $evening_out != null ? $evening_in->created_at->diffInHours($evening_out->created_at) : 0);
            }
            $dtr[$i]['overtime_hours'] = $dtr[$i]['total_hours_in_a_day'] > 0 ? $dtr[$i]['total_hours_in_a_day'] - $hrsPerDay : 0.0;
        }
        $dtr['total_hours'] = array_sum(array_column($dtr, 'total_hours_in_a_day'));
        $dtr['total_overtime_hours'] = array_sum(array_column($dtr, 'overtime_hours'));
        $dtr['total_holiday_hours'] = array_sum(array_column($dtr, 'holiday_hours'));
        $dtr['grand_total_hours'] = $dtr['total_hours'] + $dtr['total_overtime_hours'];
        $dtr['offset'] = $offset;
        $dtr['offset2'] = $offset2;

        return $dtr;
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function position()
    {
        return $this->belongsToMany(Position::class);
    }

    public function department()
    {
        return $this->belongsToMany(Department::class);
    }

    public function role()
    {
        return $this->belongsToMany(Role::class)->withTimestamps();
    }

    public function leaves()
    {
        return $this->hasMany(Leave::class, 'employee_id', 'id');
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }

    public function payslips()
    {
        return $this->hasMany(Payslip::class);
    }

    public function setFirstnameAttribute($value)
    {
        $this->attributes['firstname'] = ucfirst($value);
    }

    public function setMiddlenameAttribute($value)
    {
        $this->attributes['middlename'] = ucfirst($value);
    }

    public function setLastnameAttribute($value)
    {
        $this->attributes['lastname'] = ucfirst($value);
    }

    public function getFullNameAttribute()
    {
        return ucfirst($this->firstname)." ".ucfirst($this->middlename[0]).". ".ucfirst($this->lastname);
    }
}
