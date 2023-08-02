@extends('/Student/Student_MainPage')
@extends('layout')

@section('content')
<div class="container">
    <h2>Edit Student Information</h2>
    <form action="{{ route('student.update', $student->id) }}" method="POST">
        @csrf
        @method('PATCH')

        <!-- Form fields for editing student information -->
        <!-- Add input fields with current student details as default values -->

        <div class="form-group">
            <label for="StudentID">Student ID</label>
            <input type="text" name="student_id" class="form-control" value="{{ $student->StudentID }}" required>
        </div>

        <!-- Add other form fields for editing student details -->

        <div class="form-group">
            <button type="submit" class="btn btn-primary">Update</button>
        </div>
    </form>
</div>
@endsection