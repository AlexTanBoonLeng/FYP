@extends('layouts.app')

@section('contents')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Insert New Batch</div>
                
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
                    <form method="POST" action="{{ route('Batch.store') }}">
                        @csrf
                        <div class="form-group">
                            <label for="BatchID">Batch:</label>
                            <input type="text" class="form-control" name="BatchID" id="BatchID" required placeholder="Bos21-C2" maxlength="10">
                        </div>
                        
                   
                        
                  
                        <button type="submit" class="btn btn-primary">Add Batch</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
