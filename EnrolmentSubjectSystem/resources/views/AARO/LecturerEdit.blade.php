@extends('/AARO/AARO_MainPage')
@extends('layout')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-auto" style="width: 500px;">
            <div class="card-header">Edit Lecturer Information</div>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @foreach ($Lecturers as $lecturer)
            <form action="{{ route('lecturer.update',$lecturer->id) }}" method="POST">
            
                @csrf
                <div class="form-group">
                    <label for="id">ID:</label>
                    <input type="text" class="form-control" id="id" name="id" value="{{ $lecturer->LecturerID }}" required>
                </div>
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ $lecturer->name }}" required>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ $lecturer->email }}" required>
                </div>
                <div class="form-group">
                    <label for="faculty">Faculty:</label>
                    <input type="text" class="form-control" id="faculty" name="faculty" value="{{ $lecturer->faculty }}" required>
                </div>
                <button type="submit" class="btn btn-primary">Update Lecturer</button>
                @endforeach
            </form>
        </div>
    </div>
</div>
@endsection
