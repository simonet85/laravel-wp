@extends('layouts.master')
@section('content')
    <div class="container error-page text-center ">
        
        <div class="page-header">
            <h1>500 Internal Server Error!</h1>
        </div>
          <p class="lead">Whoops, something went wrong on our servers.</p>
          <p><a href="{{url('/blog')}}">Go to Homepage </p>
    </div>
@endsection