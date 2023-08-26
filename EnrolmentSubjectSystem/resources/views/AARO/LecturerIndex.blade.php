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
            padding: 8px;
        }

        tr:nth-child(even) {
            background-color: #dddddd;
        }

        .edit-link {
            display: inline-block;
            padding: 6px 12px;
            background-color: #007bff;
            color: #fff;
            text-align: center;
            text-decoration: none;
            cursor: pointer;
            border: none;
            border-radius: 4px;
            transition: background-color 0.3s ease;
        }

        .edit-link:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Lecturer List</div>
                <div class="card-body">
                    <table class="table">
                        <div>
                            <form action="{{ route('lecturer.search') }}" method="GET">
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" name="LecturerSearch" placeholder="Search Lecturer">
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
                                <th>Faculty</th>
                                <th>Phone Number</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($Lecturers as $lecturer)
                                <tr>
                                    <td>{{ $lecturer->LecturerID }}</td>
                                    <td>{{ $lecturer->name }}</td>
                                    <td>{{ $lecturer->email }}</td>
                                    <td>{{ $lecturer->faculty }}</td>
                                    <td>{{ $lecturer->phone_number }}</td>
                                    <td>
                                        <!-- Style the "Edit" link as a button -->
                                        <a href="{{ route('lecturer.edit', $lecturer->id) }}" class="edit-link">Edit</a>
                                        <form action="{{ route('lecturer.delete', $lecturer->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <!-- Style the "Delete" button -->
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