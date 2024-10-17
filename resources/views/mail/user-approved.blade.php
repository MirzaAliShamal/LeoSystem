@extends('mail.layout')
@section('content')
    <h1 style="text-align: center;">Dear, {{$user->name}}</h1>
    <h1 style="text-align: center;">Welcome to Our Educational Community!</h1>
    <h1 style="text-align: center;" class="text-success">{{ $content }}</h1>
    <div class="verify-button bg-yellow">Your {{ $user_type }} ID: {{ $user_id }}</div>
@endsection




