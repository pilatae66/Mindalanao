<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PayslipDetail extends Model
{
    protected $fillable = ['payslip_id', 'name', 'type', 'amount'];

    public function payslip()
    {
        return $this->belongsTo(Payslip::class);
    }
}
