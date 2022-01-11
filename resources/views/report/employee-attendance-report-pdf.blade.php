<!DOCTYPE html>
<html>
<head>
    <title>DIGITAL ADVOCACY EMPLOYEE ATTENDANCE REPORT</title>
    <style>
        table {
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid black;
        }
    </style>
</head>
<body>
<div>

    <p style="text-align:center; font-weight:bold; padding-top:5mm;">
        {{--        <img src="{{ asset('assets/media/logos/chademadigitallogo.png') }}" alt="" style="width: 150px; height: 150px;"> <br>--}}
        <br>
        DIGITAL ADVOCACY<br>
        EMAIL: CHANGEAFRICA@GMAIL.COM <br>WEBSITE:CHANGEAFRICA.COM<br><br>
        EMPLOYEE ATTENDANCE REPORT
    </p>
    <br>
    <table style="width:100%; border: 1px solid black; border-collapse: collapse;">
        <thead>
        <tr>
            <th>#NO</th>
            <th>Employee</th>
            <th>Check In</th>
            <th>Check Out</th>
            <th>Worked Hours</th>
            <th>Overtime Hours</th>
            <th>Overtime Status</th>
            <th>Late</th>
            <th>Short Time</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($employee_attendances as $employee_attendance)
            <tr>
                <td> {{ $loop->iteration }}</td>
                <td> {{ $employee_attendance->employee_first_name}} {{ $employee_attendance->employee_middle_name}} {{ $employee_attendance->employee_last_name}}</td>
                <td> {{ $employee_attendance->check_in }}</td>
                <td> {{ $employee_attendance->check_out }}</td>
                <td> {{ $employee_attendance->hours }}</td>
                <td> {{ $employee_attendance->overtime_hours }}</td>
                <td> {{ $employee_attendance->overtime_status }}</td>
                <td>
                    @if($employee_attendance->is_late == 0)
                        ON TIME
                    @else
                        LATE
                    @endif
                </td>
                <td>
                    @if($employee_attendance->is_short_time == 0)
                        WORKED FULL TIME
                    @else
                        CHECKED OUT BEFORE TIME
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>


</div>

<htmlpagefooter name="footer">

    <div id="footer">
        <p style="text-align: center;">WafriExchange@2021 </p> <b></b>
    </div>
</htmlpagefooter>
<sethtmlpagefooter name="footer" value="on" />

</body>
</html>


