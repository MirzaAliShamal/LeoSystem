@extends('mail.layout')
@section('content')
    <h1 style="text-align: center;">Dear, {{$user->name}}</h1>
    <h1 style="text-align: center;">Welcome to Our Educational Community!</h1>
    <h1 style="text-align: center;" class="text-danger">We Regret! Your {{ $user_type }} Account Has Been Blocked!</h1>
    <div class="message">
        <u>Our Recommendation!</u>
        <p>{{ $message }}</p>
    </div>
@endsection




