@extends('layouts.master')
@section('content')
    <div class="container error-page text-center ">
        
        <div class="page-header">
            <h1>404 Page Not Found!</h1>
        </div>
          <p class="lead">It seems like you requested a page that don't exists.</p>
          <p><a href="{{url('/blog')}}">Go to Homepage </p>
    </div>
@endsection