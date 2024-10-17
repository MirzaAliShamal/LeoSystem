@extends('mail.layout')
@section('content')
    <h1 style="text-align: center;">Dear, {{$user->name}}</h1>
    <h1 style="text-align: center;">Forgot Password Verification!</h1>
    <h1 style="text-align: center;">Your Verification Code for Password Recovery.</h1>
    <div class="verify-button bg-yellow">{{ $verification_code }}</div>
@endsection




