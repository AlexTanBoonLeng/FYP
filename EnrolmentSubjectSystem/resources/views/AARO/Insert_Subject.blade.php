@extends('layout')
@extends('/AARO/AARO_MainPage')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Insert New Subject</div>
                
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
                    <form method="post" action="{{ route('subject.store') }}">
                        @csrf
                        <table class="table">
                            <div class="form-group">
                                <label for="subject_id">Subject ID:</label>
                                <input type="text" class="form-control" name="subject_id" id="subject_id" required>
                            </div>
                            
                            <div class="form-group">
                                <label>Name:</label>
                                <input type="text" class="form-control" name="name" id="name" required>
                            </div>
                            
                            <div class="form-group">
                                <label>Credit:</label>
                                <input type="text" class="form-control" name="credit" id="credit" required>
                            </div>
                            
                            <div class="form-group">
                                <label>Day and Time:</label>
                                <input type="text" class="form-control" name="day_and_time[]" required>
                                <input type="text" class="form-control" name="day_and_time[]" required>
                            </div>
                            
                            <div class="form-group">
                                <label>Classroom:</label>
                                <input type="text" class="form-control" name="classroom" required>
                            </div>

                            <div class="form-group">
                                <label>Lecturer:</label>
                                <select name="lecturer_id" class="form-control">
                                    <option value="">Select Lecturer</option>
                                    @foreach($lecturers as $lecturer)
                                        <option value="{{ $lecturer->id }}">{{ $lecturer->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <br>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Insert Subject</button>
                            </div>
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection