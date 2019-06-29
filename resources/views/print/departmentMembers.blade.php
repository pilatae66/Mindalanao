<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <style>
        .page-break {
            page-break-after: always;
        }
        table {
            border-collapse: collapse; }

        th {
            text-align: inherit;
        }.table {
            width: 100%;
            margin-bottom: 1rem;
            color: #031b4e; }
        .table th,
        .table td {
            padding: 0.75rem;
            vertical-align: top;
            border-top: 1px solid #cdd4e0; }
        .table thead th {
            vertical-align: bottom;
            border-bottom: 2px solid #cdd4e0; }
        .table tbody + tbody {
                border-top: 2px solid #cdd4e0; }
    </style>
</head>
<body>
    <div style="text-align:center; margin-bottom:10px">
        <img src="images/logo/Minda.jpg" style="height:50px;" alt="">
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
            {{ $department->department_name }} Department Member List
    </div>
    <div style="text-align:center; margin-top:50px; font-size:12px">
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Employee Name</th>
                    <th>Email</th>
                    <th>Position</th>
                    <th>Department</th>
                    <th>Date Employed</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($department->employees as $employee)
                    <tr>
                        <td>{{ $employee->id }}</td>
                        <td>{{ $employee->full_name }}</td>
                        <td>{{ $employee->email }}</td>
                        <td>{{ $employee->position[0]->position }}</td>
                        <td>{{ $employee->department[0]->department_name }}</td>
                        <td>{{ $employee->created_at->format('F d, y') }}</td>
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
