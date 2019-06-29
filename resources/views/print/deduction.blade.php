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
        <img src="{{ ltrim(public_path('images/logo/Minda.jpg'), '/') }}" style="height:50px;" alt="">
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
    <div style="text-align:center; font-size:18px; margin-top:50px">
            Deduction List
    </div>
    <div style="text-align:center; margin-top:50px; font-size:12px">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Amount</th>
                    <th>Effectivity Date</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($deductions as $deduction)
                    <tr>
                        <td>{{ $deduction->name }}</td>
                        <td>P{{ number_format($deduction->amount, 2, '.', ',') }}</td>
                        <td>{{ $deduction->created_at->format('F d, Y') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" style="text-align:center">No Data Available</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</body>
</html>
