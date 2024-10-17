@extends('mail.layout')
@section('content')
    <h1 style="text-align: center;">Dear, {{$user->name}}</h1>
    <h1 style="text-align: center;">Thank You for Registration!</h1>
    <h1 style="text-align: center;">Please, Confirm Your Email.</h1>
    <a href="{{$link}}" class="verify-button bg-yellow">Verify My Email</a>
@endsection



