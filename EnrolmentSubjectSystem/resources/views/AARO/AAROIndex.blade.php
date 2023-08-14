@extends('layout')

@section('content')
<head>
    @extends('/AARO/AARO_MainPage')
    <style>
        /* Your styles here */
    </style>
</head>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">AARO List</div>
                <div class="card-body">
                    <div>
                        <form action="{{ route('AARO.search') }}" method="GET">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" name="AAROSearch" placeholder="Search AARO">
                                <div class="input-group-append">
                                    <button class="btn btn-light" type="submit">Search</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone_number</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($Aaro as $AARO)
                                <tr>
                                    <td>{{ $AARO->AAROID }}</td>
                                    <td>{{ $AARO->name }}</td>
                                    <td>{{ $AARO->email }}</td>
                                    <td>{{ $AARO->phone_number }}</td>
                                    <td>
                                        <form action="{{ route('AARO.delete', $AARO->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
