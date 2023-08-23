
@extends('layouts.StudentApp')
@section('contents')
<head>

</head>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-auto" style="width: 500px;">
            <div class="card-header">Edit Personal Information</div>
            
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            
            @foreach ($Students as $student)
            <form action="{{ route('student.update', session('user')->userID) }}" method="POST">
                @csrf
                
                <div class="form-group">
                    <label for="id">ID:</label>
                    <input type="text" class="form-control" id="id" name="id" value="{{ $student->StudentID }}" disabled>
                </div>
                
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ $student->name }}" disabled>
                </div>
             
                <div class="form-group">
                    <label for="phone_number">Phone Number:</label>
                    <input type="text" class="form-control" id="phone_number" name="phone_number" value="{{ $student->phone_number }}" required>
                </div>
                
                <div class="form-group">
                    <label for="address">Address:</label>
                    <input type="text" class="form-control" id="address" name="address" value="{{ $student->address }}" required>
                </div>
                
                <button type="submit" class="btn btn-primary">Update Student</button>
            </form>
            @endforeach
        </div>
    </div>
</div>
@endsection