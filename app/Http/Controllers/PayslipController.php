<?php

namespace App\Http\Controllers;

use App\Payslip;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\User;
use PDF;

class PayslipController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //code...
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Payslip  $payslip
     * @return \Illuminate\Http\Response
     */
    public function show(Payslip $payslip)
    {

    }

    public function employeeShow($user)
    {
        $payslip = Payslip::where('user_id', $user)->latest()->first();
        if($payslip){
            $deductions = $payslip->deductions();
            $benefits = $payslip->benefits();

            return view('payslip.employeeShow', compact('payslip', 'deductions', 'benefits'));
        }else{
            return abort(404);
        }
    }

    public function HROShow(Payslip $payslip)
    {
        dd($payslip);
        if (!empty($payslip)) {
            $deductions = $payslip->deductions();
            $benefits = $payslip->benefits();
            return view('payslip.employeeShow', compact('payslip', 'deductions', 'benefits'));
        }
        else{
            return abort(404);
        }
    }

    public function showAll(User $user)
    {
        $payslips = $user->payslips;

        return view('payslip.showAll', compact('payslips', 'user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Payslip  $payslip
     * @return \Illuminate\Http\Response
     */
    public function edit(Payslip $payslip)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Payslip  $payslip
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Payslip $payslip)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Payslip  $payslip
     * @return \Illuminate\Http\Response
     */
    public function destroy(Payslip $payslip)
    {
        //
    }

    public function printPayslips(Payslip $payslip)
    {
        $deductions = $payslip->deductions();
        $benefits = $payslip->benefits();
        $pdf = PDF::loadView('print.payslip', compact('payslip', 'deductions', 'benefits'));
        // dd($pdf);
        return $pdf->stream('payslip.pdf');

    }
}
