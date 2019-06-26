<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payslip extends Model
{
    protected $fillable = ['user_id', 'gross_salary', 'net_salary'];

    public function details()
    {
        return $this->hasMany(PayslipDetail::class);
    }

    public function deductions()
    {
        return $this->details->where('type', 'Deductions');
    }

    public function benefits()
    {
        return $this->details->where('type', 'Benefits');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
