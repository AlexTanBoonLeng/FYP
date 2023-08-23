@extends('layouts.app')

@section('contents')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Insert New Lecturer</div>
                
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
                    <form method="POST" action="{{ route('Lecturer.store') }}">
                        @csrf
                        <div class="form-group">
                            <label for="LecturerID">Lecturer ID:</label>
                            <input type="text" class="form-control" name="LecturerID" id="LecturerID" required placeholder="LC3547" maxlength="7">
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
                            <label for="faculty">Faculty:</label>
                            <select name="faculty" id="faculty" class="form-control">
                                <option value="IT & Engineering">IT & Engineering</option>
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
                        <button type="submit" class="btn btn-primary">Create Lecturer</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
