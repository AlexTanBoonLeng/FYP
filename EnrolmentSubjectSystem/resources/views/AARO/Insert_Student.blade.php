@extends('layouts.app')

@section('contents')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Insert New Student</div>
                
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
                    <form method="POST" action="{{ route('Student_InsertNewStudent') }}">
                        @csrf
                        <div class="form-group">
                            <label for="StudentID">Student ID:</label>
                            <input type="text" class="form-control" name="StudentID" id="StudentID" required maxlength="8">
                        </div>
                        
                        <div class="form-group">
                            <label for="password">Password:</label>
                            <input type="password" class="form-control" name="password" id="password" required maxlength="8">
                        </div>
                        
                        <div class="form-group">
                            <label for="name">Name:</label>
                            <input type="text" class="form-control" name="name" id="name" required maxlength="50">
                        </div>
                        
                        <div class="form-group">
                            <label for="ic">IC:</label>
                            <input type="text" class="form-control" name="ic" required placeholder="IC eg. 990104-07-5555" maxlength="14">
                        </div>
                        
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" class="form-control" name="email" required maxlength="50">
                        </div>
                        
                        <div class="form-group">
                            <label for="phone_number">Phone Number:</label>
                            <input type="tel" class="form-control" name="phone_number" required placeholder="Tel eg. 017-4139389" maxlength="11">
                        </div>
                        
                        <div class="form-group">
                            <label for="address">Address:</label>
                            <input type="text" class="form-control" name="address" required maxlength="200">
                        </div>
                        
                        <div class="form-group">
                            <label for="faculty">Faculty:</label>
                            <select name="faculty" id="faculty" class="form-control">
                                <option value="IT & Engineering">IT & Engineering</option>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label for="course">Course:</label>
                            <select name="course" id="course" class="form-control">
                                <option value="Diploma in Information Technology">Diploma in Information Technology</option>
                                <option value="Bachelor of Software Engineering (Honours)">Bachelor of Software Engineering (Honours)</option>
                                <option value="Master of Science (Computer Science)">Master of Science (Computer Science)</option>
                            </select>
                        </div>
                        
                        <div class="form-group">
                                <label>Batch:</label>
                                <select name="batch_id" class="form-control">
                                    <option value="">Select Batch</option>
                                    @foreach($Batchs as $batch)
                                        <option value="{{ $batch->id }}">{{ $batch->BatchID }}</option>
                                    @endforeach
                                </select>
                            </div>
                        
                        <div class="form-group">
                            <label for="gender">Gender:</label>
                            <select name="gender" id="gender" class="form-control">
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </div>
                        
                        <br>
                        
                        <button type="submit" class="btn btn-primary">Create Student</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
