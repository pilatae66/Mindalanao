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
            Employee Time Sheet
    </div>
    <div class="row mb-4">
        <div class="col">
            <div class="wd-50p">
                <div>Employee Name: {{ $user->full_name }}</div><br />
                <div>Week Starting:  {{ $day <= 15 ? $month.'/1/2019' : $month.'/16/2019' }}</div>
            </div>
        </div>
    </div>
    <div class="row mt-5">
        <div class="col-12">
            <table class="table table-bordered">
                <thead class="tx-center">
                    <tr>
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
                    </tr>
                </thead>
                <tbody>
                    @foreach ($dtrs as $key => $dtr)
                        @if ($key > $dtrs['offset2'] )
                            <tr class="tx-10">
                                <td class="align-middle tx-center">{{ $dtr['day'] }}</td>
                                <td class="tx-center">{{ $dtr['Morning In'] }}</td>
                                <td class="tx-center">{{ $dtr['Morning Out'] }}</td>
                                <td class="tx-center">{{ $dtr['Afternoon In'] }}</td>
                                <td class="tx-center">{{ $dtr['Afternoon Out'] }}</td>
                                <td class="tx-center">{{ $dtr['Evening In'] }}</td>
                                <td class="tx-center">{{ $dtr['Evening Out'] }}</td>
                                <td class="align-middle tx-center">{{ number_format($dtr['total_hours_in_a_day'], 1, '.', ',') }}</td>
                                <td class="align-middle tx-center">8.0</td>
                                <td class="align-middle tx-center">{{ $dtr['overtime_hours'] > 0 ? number_format($dtr['overtime_hours'],1,'.',',') : number_format(0, 1, '.', ',') }}</td>
                                <td class="align-middle tx-center">{{ $dtr['holiday_hours'] > 0 ? number_format($dtr['holiday_hours'],1,'.',',') : number_format(0, 1, '.', ',') }}</td>
                            </tr>
                        @endif
                    @endforeach
                    <tr class="tx-12 ">
                        <td class="border-0"></td>
                        <td class="border-0"></td>
                        <td class="border-0"></td>
                        <td class="border-0"></td>
                        <td class="border-0"></td>
                        <td class="border-0"></td>
                        <td colspan="2" class="align-middle tx-right border-0">Total hours:</td>
                        <td class="align-middle tx-center border-0">{{ number_format($dtrs['total_hours'],1 ,'.',',') }}</td>
                        <td class="align-middle tx-center border-0">{{ number_format($dtrs['total_overtime_hours'],1 ,'.',',') }}</td>
                        <td class="align-middle tx-center border-0">{{ number_format($dtrs['total_holiday_hours'],1 ,'.',',') }}</td>
                    </tr>
                    <tr class="tx-12 ">
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
</body>
</html>
