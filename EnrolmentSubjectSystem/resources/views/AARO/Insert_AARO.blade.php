@extends('layout')
@extends('/AARO/AARO_MainPage')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Insert New AARO</div>
                
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
                    <form method="POST" action="{{ route('AARO.store') }}">
                        @csrf
                        <div class="form-group">
                            <label for="AAROID">AARO ID:</label>
                            <input type="text" class="form-control" name="AAROID" id="AAROID" required placeholder="A0001" maxlength="5">
                        </div>
                        
                        <div class="form-group">
                            <label for="password">Password:</label>
                            <input type="password" class="form-control" name="password" id="password" required maxlength="5">
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
                        <br>
                        <button type="submit" class="btn btn-primary">Create AARO</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection