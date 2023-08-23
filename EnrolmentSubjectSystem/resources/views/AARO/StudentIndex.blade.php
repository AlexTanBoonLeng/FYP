@extends('layouts.app')

@section('contents')
<head>
  
    <style>
        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        td, th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 18px;
        }

        tr:nth-child(even) {
            background-color: #dddddd;
        }
    </style>
</head>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Student List</div>
                <div class="card-body">
                    <table class="table">
                        <div>
                            <form action="{{ route('student.search') }}" method="GET">
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" name="StudentSearch" placeholder="Search Student">
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
    
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>IC</th>
                                <th>Faculty</th>
                                <th>Course</th>
                                <th>Batch</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($students as $student)
                                <tr>
                                    <td>{{ $student->StudentID }}</td>
                                    <td>{{ $student->name }}</td>
                                    <td>{{ $student->email }}</td>
                                    <td>{{ $student->ic }}</td>
                                    <td>{{ $student->faculty }}</td>
                                    <td>{{ $student->course }}</td>
                                    <td>{{ $student->batch->BatchID }}</td>
                                    <td>
                                        <form action="{{ route('student.delete', $student->id) }}" method="POST">
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