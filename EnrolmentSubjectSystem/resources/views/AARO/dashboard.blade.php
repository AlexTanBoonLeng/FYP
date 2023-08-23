@extends('layouts.app')

@section('title', '')

@section('contents')
    <div class="row">
     <h2>   Welcome,@if(session()->has('user')) {{ session('user')->userID }}
     {{ session('user')->name }} </h2>
     @endif
    </div>
@endsection