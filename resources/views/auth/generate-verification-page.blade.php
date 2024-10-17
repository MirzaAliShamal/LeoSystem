@extends('layouts.auth')

@section('content')
    <!-- Sing In Area Start -->
    <section class="sign-up-page p-0">
        <div class="container-fluid p-0">
            <div class="row">
                <div class="col-md-5">
                    <div class="sign-up-left-content">
                        <div class="sign-up-top-logo">
                            <a href="{{ route('main.index') }}"><img src="{{getImageFile(get_option('app_logo'))}}" alt="logo"></a>
                        </div>
                        <p>{{ __(get_option('sign_up_left_text')) }}</p>
                        @if(get_option('sign_up_left_image'))
                            <div class="sign-up-bottom-img">
                                <img src="{{getImageFile(get_option('sign_up_left_image'))}}" alt="hero" class="img-fluid">
                            </div>
                        @endif
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="sign-up-right-content bg-white">
                        <form action="{{ route('send-verification-code') }}" method="post">
                            @csrf

                            <h5 class="mb-1">Send Verification Code</h5>
                            <div class="forgot-pass-text mb-25 mt-3">
                                <p class="mb-2 text-muted">Just to make sure it's you, choose how you would like to get verification code:</p>
                            </div>

                            <div class="row mb-30">
                                <input type="hidden" name="user-id" value="{{ $user->id }}">
                                <div class="col-md-12 p-1 d-flex gap-3">
                                    <input type="radio" name="verify-by" class="form-check-input" value="phone" id="verify-by-phone" autocomplete="off">
                                    <label class="form-check-label" for="verify-by-phone">Via text at <span class="font-bold">{{ \Illuminate\Support\Str::mask('+'.$user->mobile_number,'*',3,-2) }}</span></label>
                                </div>
                                <hr class="mt-2 mb-3">
                                <div class="col-md-12 p-1 d-flex gap-3">
                                    <input type="radio" name="verify-by" class="form-check-input" checked value="email" id="verify-by-email" autocomplete="off">
                                    <label class="form-check-label" for="verify-by-email">Via email at <span class="font-bold">{{ \Illuminate\Support\Str::mask($user->email,'*',2,-10) }}</span></label>
                                </div>
                            </div>
                            <div class="row mb-30">
                                <div class="col-md-12">
                                    <button type="submit" class="theme-btn theme-button1 theme-button3 font-15 fw-bold w-100">Send</button>
                                </div>
                            </div>
                            <div class="row mb-30">
                                <div class="col-md-12"><a href="{{ route('login') }}" class="color-hover text-decoration-underline font-medium">{{ __('Back to Login?') }}</a></div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Sing In Area End -->
@endsection
