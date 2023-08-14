@extends('layout')


<head>
@extends('/AARO/AARO_MainPage')

</head>
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Edit Subject Information</div>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @foreach ($Subjects as $subject)
                <form action="{{ route('subject.update', $subject->id) }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="subject_id">Subject ID:</label>
                        <input type="text" class="form-control" id="subject_id" name="subject_id" value="{{ $subject->subject_id }}" required>
                    </div>
                    <div class="form-group">
                        <label for="name">Subject Name:</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ $subject->name }}" required>
                    </div>
                    <div class="form-group">
                        <label for="credit">Credit:</label>
                        <input type="Integer" class="form-control" id="credit" name="credit" value="{{ $subject->credit }}" required>
                    </div>
                    <div class="form-group">
                        <label for="day_and_time">Day and Time:</label>
                        <input type="text" class="form-control" id="day_and_time[]" name="day_and_time" value="{{ $subject->day_and_time }}" required>
                    </div>
                    <div class="form-group">
                        <label for="classroom">Venue:</label>
                        <input type="text" class="form-control" id="classroom" name="classroom" value="{{ $subject->classroom }}" required>
                    </div>
                    <div class="form-group">
                        <label for="lecturer_id">Lecturer Name:</label>
                        <select name="lecturer_id" class="form-control">
                            <option value="">Select Lecturer</option>
                            @foreach($lecturers as $lecturer)
                                <option value="{{ $lecturer->id }}">{{ $lecturer->name }}</option>
                            @endforeach
                        </select><br>
                    </div>
                    <button type="submit" class="btn btn-primary">Update Subject</button>
                </form>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection