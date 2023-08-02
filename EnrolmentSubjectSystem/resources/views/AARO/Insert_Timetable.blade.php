@extends('layout')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Create Timetable Entry</div>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="card-body">
                    <form method="post" action="{{ route('timetables.store') }}">
                        @csrf
                        <div class="form-group">
                            <label for="subject_id">Subject:</label>
                            <select name="subject_id" class="form-control" required>
                                <option value="">Select Subject</option>
                                @foreach ($subjects as $subject)
                                    <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="day_and_time">Day and Time (Comma Separated):</label>
                            <input type="text" class="form-control" name="day_and_time" required>
                        </div>
                        <div class="form-group">
                            <label for="classroom">Classroom:</label>
                            <input type="text" class="form-control" name="classroom" required>
                        </div>
                        <div class="form-group">
                            <label for="lecturer_id">Lecturer (Optional):</label>
                            <select name="lecturer_id" class="form-control">
                                <option value="">Select Lecturer</option>
                                @foreach ($lecturers as $lecturer)
                                    <option value="{{ $lecturer->id }}">{{ $lecturer->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Save Timetable</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
