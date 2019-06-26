@extends('layouts.app')
{{--
@section('title')
    Hi, {{ auth()->user()->firstname }} welcome back!
@endsection --}}

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card card-body pd-40">
                <div class="tx-center">
                    <div class="pb-3"><img src="{{ asset('images/logo/Minda.jpg') }}" style="height:50px;"></div>
                    <div class=""><h4 class="card-title">Mindalano Specialist Hospital</h4></div>
                    <div class=""><h4 class="card-title">Payslip</h4></div>
                </div>

                <div class="row pd-40 pb-0">
                    <div class="col-md-6 tx-center">
                        <div>{{ $payslip->user->full_name }}</div>
                        <hr class="p-0 m-0">
                        <div>Employee</div>
                    </div>
                    <div class="col-md-6 tx-center">
                        <div>{{ $payslip_count < 0 ? "{$payslip->created_at->format('F')} 1-15, 2019" : "{$payslip->created_at->format('F')} 15-30, 2019" }} </div>
                        <hr class="p-0 m-0">
                        <div>Pay Ending</div>
                    </div>
                </div><!-- end row -->
                <div class="row pd-40 pb-0 pt-4">
                    <div class="col-md-6 tx-center">
                        <div>{{ $payslip->user->position[0]->position }}</div>
                        <hr class="p-0 m-0">
                        <div>Position</div>
                    </div>
                    <div class="col-md-6 tx-center">
                        <div>{{ $payslip_count < 0 ? "{$payslip->created_at->format('F')} 10, 2019" : "{$payslip->created_at->format('F')} 20, 2019" }}</div>
                        <hr class="p-0 m-0">
                        <div>Pay Date</div>
                    </div>
                </div><!-- end row -->
                <div class="d-flex justify-content-between align-items-center my-3">
                    <div class="wd-50p bd pd-10">
                        <div class="d-flex justify-content-between">
                            <div class="tx-bold">Gross Pay:</div>
                            <div>₱{{ number_format($payslip->gross_salary, 2, '.', ',') }}</div>
                        </div>
                    </div>
                    <div class="wd-40p bd pd-10">
                        <div class="d-flex justify-content-between">
                            <div class="tx-bold">Rate/Day:</div>
                            <div>₱365.00</div>
                        </div>
                    </div>
                </div><!-- end row -->
                <div class="d-flex justify-content-between">
                    <div class="wd-50p">
                        <div class="card bd-0">
                            <div class="card-header tx-medium bd tx-black bg-white tx-center">
                                DEDUCTIONS
                            </div><!-- card-header -->
                            <div class="card-body bd bd-t-0">
                                @forelse ($deductions as $deduction)
                                    <div class="d-flex justify-content-between">
                                        <div>{{ $deduction->name }}</div>
                                        <div>₱{{ number_format($deduction->amount, 2, '.', ',') }}</div>
                                    </div>
                                @empty
                                    <div class="d-flex justify-content-between">
                                        <div>No Deductions Available</div>
                                        <div>-</div>
                                    </div>
                                @endforelse
                            </div><!-- card-body -->
                        </div><!-- card -->
                    </div>
                    <div class="wd-40p">
                        <div class="card bd-0">
                            <div class="card-header tx-medium bd tx-black bg-white tx-center">
                                DTR
                            </div><!-- card-header -->
                            <div class="card-body bd bd-t-0">
                                <div class="d-flex justify-content-between">
                                    <div>Days Work</div>
                                    <div>12.0</div>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="tx-10">OT(No. of hours)</div>
                                    <div>-</div>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <div>HOLIDAY</div>
                                    <div>₱730.00</div>
                                </div>
                            </div><!-- card-body -->
                        </div><!-- card -->
                    </div>
                </div>
                <div class="wd-50p bd pd-10 mt-3">
                    <div class="d-flex justify-content-between">
                        <div class="tx-bold">NET PAY:</div>
                        <div>₱{{ number_format($payslip->net_salary, 2, '.', ',') }}</div>
                    </div>
                </div>
            </div><!-- card -->
        </div>
    </div>
@endsection
