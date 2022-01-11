<html>
<head>
    <style>
        table {
            border: 1px dashed #000;
        }
    </style>
</head>
<body>
<table>
    <tbody>
    <tr>

        <th colspan="5"><b>DIGITAL ADVOCACY</b><br><b>EMAIL: CHANGEAFRICA@GMAIL.COM WEBSITE:CHANGEAFRICA.COM</b><br><b>EMPLOYEE ATTENDANCE REPORT EXCEL</b></th>
    </tr>
    <tr></tr>
    <tr style="background-color: #ffb53a; color: #FFFFFF;">
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
</body>
</html>

