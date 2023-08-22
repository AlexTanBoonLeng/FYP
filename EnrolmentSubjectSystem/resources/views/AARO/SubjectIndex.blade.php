
@extends('layout')
<head>
    @extends('/AARO/AARO_MainPage')
    <style>
        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        td, th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        tr:nth-child(even) {
            background-color: #dddddd;
            
        }
        .edit-link:hover {
            background-color: #0056b3;
        }
        .edit-link {
            display: inline-block;
            padding: 6px 12px;
            background-color: #007bff;
            color: #fff;
            text-align: center;
            text-decoration: none;
            cursor: pointer;
            border: none;
            border-radius: 4px;
            transition: background-color 0.3s ease;
             /* Add new styles */
        }
        .form-controls {
            display: flex;
            align-items: center;
        }

        .select-container {
            display: flex;
            align-items: center;
            margin-left: 200px; /* Adjust this value as needed */
           
        }
        
    </style>
</head>
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Subject List</div>
                <div class="card-body">
                    <form action="{{ route('timetable.enroll') }}" method="POST">
                        @csrf
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Credit</th>
                                    <th>Day and Time</th>
                                    <th>Classroom</th>
                                    <th>Lecturer</th>
                                    <th>Action</th>
                                    <th>Select</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($Subjects as $subject)
                                    <tr>
                                        <td>{{ $subject->subject_id }}</td>
                                        <td>{{ $subject->name }}</td>
                                        <td>{{ $subject->credit }}</td>
                                        <td>{{ $subject->day_and_time }}</td>
                                        <td>{{ $subject->classroom }}</td>
                                        <td>
                                            @if ($subject->lecturer)
                                                {{ $subject->lecturer->name }}
                                            @else
                                                No Assigned Lecturer
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('subject.edit', $subject->id) }}" class="edit-link">Edit</a>
                                           
                                        </td>
                                        <td>
                                            <input type="checkbox" name="selected_subjects[]" value="{{ $subject->id }}">
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="form-group">
                            <label for="remark">Remarks :</label>
                            <input type="text" class="form-control" name="remark" required placeholder="eg. 2023B IT" maxlength="100"><br>

                        </div>
                        <div class="form-controls">
                            <button type="submit" class="btn btn-primary">Enroll Selected Subjects</button><br>
                           
                        </div>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
