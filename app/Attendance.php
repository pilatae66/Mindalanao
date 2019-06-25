<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $fillable = ['user_id', 'type'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
