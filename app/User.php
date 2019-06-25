<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use QrCode;
use DB;

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

    public function getNextId()
    {

     $statement = DB::select("SHOW TABLE STATUS LIKE 'users'");

     return $statement[0]->Auto_increment;
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
