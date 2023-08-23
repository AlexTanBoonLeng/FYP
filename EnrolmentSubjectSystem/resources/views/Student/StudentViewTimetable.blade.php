@extends('layouts.StudentApp')

@section('contents')
<div class="container">
    <h1>Timetable</h1>

    <table class="table">
        <thead>
            <tr>
                <th></th> <!-- Empty cell for the corner -->
                @foreach ($daysOfWeek as $day)
                <th>{{ $day }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @for ($hour = $startHour; $hour <= $endHour; $hour++)
            <tr>
                <th>{{ $hour }}:00</th>
                @foreach ($daysOfWeek as $day)
                    @php
                        $class = null;
                        if (isset($processedDataByDayHour[$day][$hour])) {
                            $class = $processedDataByDayHour[$day][$hour][0]; // Assuming one class per hour
                        }
                    @endphp
                    <td>
                        @if ($class)
                            {{ $class['subject_id'] }}<br>
                             {{ $class['name'] }}<br>
                             {{ $class['classroom'] }}
                            <!-- Include other relevant data -->
                        @endif
                    </td>
                @endforeach
            </tr>
            @endfor
        </tbody>
    </table>
</div>
@endsection