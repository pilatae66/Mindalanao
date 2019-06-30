@extends('layouts.app')

@section('title')
Employee Time Sheet
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-white">
                    <a href="{{ route('print.dtr', ['user' => $user->id, 'year' => $year, 'month' => $month, 'day' => $day]) }}" class="btn tx-primary bg-white btn-rounded float-right" data-toggle="tooltip" data-placement="top" title="Print DTR">
                        <i class="icon ion-md-print"></i> Print
                    </a>
                </div>
                <div class="card-body pd-40">
                    <h3 class="card-title ml-auto mr-auto mb-5 tx-center">Employee Time Sheet</h3>
                <div class="d-flex">
                    <div class="wd-50p">
                        <h4>Mindalanao Specialist Hospital</h4><br />
                        <div>Panggao Saduc,</div>
                        <div>Marawi City, Lanao del Sur, Philippines</div>
                        <div>+63999999999</div>
                    </div>
                    <div class="wd-50p pt-4">
                        <div>Employee Name: {{ $user->full_name }}</div><br />
                        <div>Week Starting:  {{ $day <= 15 ? $month.'/1/2019' : $month.'/16/2019' }}</div>
                    </div>
                </div>
                <div class="table-responsive mt-5">
                    <table class="table table-bordered">
                        <thead class="tx-center border-bottom">
                            <th>Day of Week</th>
                            <th>Time In</th>
                            <th>Time Out</th>
                            <th>Time In</th>
                            <th>Time Out</th>
                            <th>Time In</th>
                            <th>Time Out</th>
                            <th>Total Hrs</th>
                            <th>Regular Hrs</th>
                            <th>Overtime Hrs</th>
                            <th>Holiday Hrs</th>
                        </thead>
                        <tbody class="border-0">
                            @for ($i = $dtr['offset'] + 1; $i <= 15 + $dtr['offset2']; $i++)
                            <tr class="tx-10">
                                <td class="border-0 align-middle tx-center">{{ $dtr[$i]['day'] }}</td>
                                <td class="tx-center">{{ $dtr[$i]['Morning In'] }}</td>
                                <td class="border tx-center">{{ $dtr[$i]['Morning Out'] }}</td>
                                <td class="border tx-center">{{ $dtr[$i]['Afternoon In'] }}</td>
                                <td class="border tx-center">{{ $dtr[$i]['Afternoon Out'] }}</td>
                                <td class="border tx-center">{{ $dtr[$i]['Evening In'] }}</td>
                                <td class="border tx-center">{{ $dtr[$i]['Evening Out'] }}</td>
                                <td class="border-right-0 align-middle tx-center">{{ number_format($dtr[$i]['total_hours_in_a_day'], 1, '.', ',') }}</td>
                                <td class="border-left-0 align-middle tx-center">8.0</td>
                                <td class="border align-middle tx-center">{{ $dtr[$i]['overtime_hours'] > 0 ? number_format($dtr[$i]['overtime_hours'],1,'.',',') : number_format(0, 1, '.', ',') }}</td>
                                <td class="border align-middle tx-center">{{ $dtr[$i]['holiday_hours'] > 0 ? number_format($dtr[$i]['holiday_hours'],1,'.',',') : number_format(0, 1, '.', ',') }}</td>
                            </tr>
                            @endfor
                            <tr class="tx-12 border-0">
                                <td class="border-0"></td>
                                <td class="border-0"></td>
                                <td class="border-0"></td>
                                <td class="border-0"></td>
                                <td class="border-0"></td>
                                <td class="border-0"></td>
                                <td colspan="2" class="align-middle tx-right border-0">Total hours:</td>
                                <td class="align-middle tx-center border-0">{{ number_format($dtr['total_hours'],1 ,'.',',') }}</td>
                                <td class="align-middle tx-center border-0">{{ number_format($dtr['total_overtime_hours'],1 ,'.',',') }}</td>
                                <td class="align-middle tx-center border-0">{{ number_format($dtr['total_holiday_hours'],1 ,'.',',') }}</td>
                                <td class="align-middle tx-center border-0"></td>
                            </tr>
                            <tr class="tx-12 border-0">
                                <td class="border-0"></td>
                                <td class="border-0"></td>
                                <td class="border-0"></td>
                                <td class="border-0"></td>
                                <td class="border-0"></td>
                                <td class="border-0"></td>
                                <td colspan="2" class="align-middle tx-right border-0">Grand Total hours:</td>
                                <td class="align-middle tx-center border-0">{{ number_format($dtr['grand_total_hours'],1 ,'.',',') }}</td>
                                <td class="border-0"></td>
                                <td class="border-0"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
