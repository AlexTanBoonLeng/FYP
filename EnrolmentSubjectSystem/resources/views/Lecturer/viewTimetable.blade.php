@extends('layout')
@extends('/Lecturer/Lecturer_MainPage')

@section('content')
<head>
    <title>Timetable</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: center;
        }

        th {
            background-color: #f2f2f2;
        }

        .time-slot {
            min-width: 100px;
            text-align: left;
        }
    </style>
</head>
<body>
    <h1>Weekly Timetable</h1>

    <table>
        <tr>
        @foreach ($subjects as $subject)
            <th class="time-slot"></th>
            <th>{{ $subject->day_and_time }}</th>
            <th>Tuesday</th>
            <th>Wednesday</th>
            <th>Thursday</th>
            <th>Friday</th>
        </tr>
        @endforeach
        <?php for ($hour = 7; $hour <= 17; $hour++): ?>
            <tr>
                <td class="time-slot"><?= $hour . ':00 - ' . ($hour + 1) . ':00'; ?></td>
                <?php for ($day = 'Monday'; $day <= 'Friday'; $day = date('l', strtotime("$day +1 day"))): ?>
                    <td>
                        <?php $subjectFound = false; ?>
                      
                            <?php
                            $subjectDayAndTime = explode(' ', $subject->day_and_time);
                            $subjectDay = $subjectDayAndTime[0];
                            $subjectTime = $subjectDayAndTime[1];
                            if ($subjectDay === $day && $subjectTime === $hour . ':00-' . ($hour + 1) . ':00') {
                                echo $subject->name;
                                $subjectFound = true;
                                break;
                            }
                            ?>
                     
                        @if (!$subjectFound)
                       
                        @endif
                    </td>
                <?php endfor; ?>
            </tr>
        <?php endfor; ?>
    </table>
</body>
@endsection
