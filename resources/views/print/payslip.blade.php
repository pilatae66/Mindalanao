<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ ltrim(public_path('css/azia.css'), '/') }}">
    <style>
        .page-break {
            page-break-after: always;
        }
    </style>
</head>
<body>
    <div class="card-body pd-40">
        <div style="text-align:center; margin-bottom:10px">
            <img src="{{ ltrim(public_path('images/logo/Minda.jpg'), '/') }}" style="height:80px;" alt="">
        </div>
        <div style="text-align:center; font-size:20px">
            Mindalanao Specialist Hospital, Inc.
        </div>
        <div style="text-align:center; font-size:12px">
                Panggao Saduc, Marawi City, <br />Lanao del Sur, Philippines
        </div>
        <div style="text-align:center; font-size:12px">
                +63999999999
        </div>
        <div class="mt-5 mb-2" style="text-align:center; font-size:18px;">
                Payslip
        </div>

        <div class="row pb-0 mt-4">
            <div class="col-5 tx-center">
                <div>{{ $payslip->user->full_name }}</div>
                <hr class="p-0 m-0">
                <div>Employee</div>
            </div>
            <div class="col-5 tx-center float-right">
                <div>{{ $payslip->created_at->day < 15 ? "{$payslip->created_at->format('F')} 1-15, 2019" : "{$payslip->created_at->format('F')} 15-30, 2019" }} </div>
                <hr class="p-0 m-0">
                <div>Pay Ending</div>
            </div>
        </div><!-- end row -->
        <div class="row pb-0 mt-4">
            <div class="col-5 tx-center">
                <div>{{ $payslip->user->position[0]->position }}</div>
                <hr class="p-0 m-0">
                <div>Position</div>
            </div>
            <div class="col-5 tx-center float-right">
                <div>{{ $payslip->created_at->day < 15 ? "{$payslip->created_at->format('F')} 20, 2019" : "{$payslip->created_at->addMonth()->format('F')} 10, 2019" }}</div>
                <hr class="p-0 m-0">
                <div>Pay Date</div>
            </div>
        </div><!-- end row -->
        <div class="row mt-2">
            <div class="col-5 bd">
                <div class="row">
                    <div class="col d-flex">
                        <div class="tx-bold pt-3">Gross Pay:</div>
                        <div class="float-right pt-3">P{{ number_format($payslip->gross_salary, 2, '.', ',') }}</div>
                    </div>
                </div>
            </div>
            <div class="col-5 bd float-right">
                <div class="row">
                    <div class="col d-flex">
                        <div class="tx-bold pt-3">Rate/Day:</div>
                        <div class="float-right pt-3">P{{ number_format($payslip->user->position[0]->salary,2, '.', ',') }}</div>
                    </div>
                </div>
            </div>
        </div><!-- end row -->
        <div class="row my-2">
            <div class="wd-400 m-0 p-0">
                <div class="bd-0">
                    <div class="card-header tx-medium bd tx-black bg-white tx-center">
                        DEDUCTIONS
                    </div><!-- card-header -->
                    <div class="card-body bd bd-t-0">
                        @forelse ($deductions as $deduction)
                            <div class="row">
                                <div class="col-12 d-flex">
                                    <div>{{ $deduction->name }}</div>
                                    <div class="float-right">P{{ number_format($deduction->amount, 2, '.', ',') }}</div>
                                </div>
                            </div>
                        @empty
                            <div class="row">
                                <div class="col-12 d-flex">
                                    <div>No Deductions Available</div>
                                    <div>-</div>
                                </div>
                            </div>
                        @endforelse
                    </div><!-- card-body -->
                </div><!-- card -->
            </div>
            <div class="wd-250 p-0 m-0 float-right">
                <div class="bd-0">
                    <div class="card-header tx-medium bd tx-black bg-white tx-center">
                        DTR
                    </div><!-- card-header -->
                    <div class="card-body bd bd-t-0">
                        <div class="row">
                            <div class="col-12 d-flex">
                                <div>Days Work</div>
                                <div class="float-right">{{ number_format($payslip->user->dtrDataEmployee(Carbon\Carbon::now()->month, Carbon\Carbon::now()->year, Carbon\Carbon::now()->day)['total_hours'], 1, '.', ',') }}</div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 d-flex">
                                <div class="tx-15">OT(No. of hours)</div>
                                <div class="float-right">{{ number_format($payslip->user->dtrDataEmployee(Carbon\Carbon::now()->month, Carbon\Carbon::now()->year, Carbon\Carbon::now()->day)['total_overtime_hours'], 1, '.', ',') }}</div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 d-flex">
                                <div>HOLIDAY</div>
                                <div class="float-right">P0.00</div>
                            </div>
                        </div>
                    </div><!-- card-body -->
                </div><!-- card -->
            </div>
        </div>
        <div class="row">
                <div class="col-5 bd">
                <div class="row ">
                    <div class="col d-flex">
                        <div class="tx-bold pt-3">NET PAY:</div>
                        <div class="float-right pt-3">P{{ number_format($payslip->net_salary, 2, '.', ',') }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div><br /><br /><br />
    <div class="row pb-0">
        <div class="col-5 tx-center">
            <hr class="p-0 m-0">
            <div>Manager</div>
        </div>
        <div class="col-5 tx-center float-right">
            <hr class="p-0 m-0">
            <div>HRO</div>
        </div>
    </div><!-- end row -->
</body>
</html>
