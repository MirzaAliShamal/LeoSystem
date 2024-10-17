@extends('layouts.auth')

@push('style')
    <style>
        .title{
            font-size: 24px;
        }
        .app-logo{
            border-radius: 0 !important;
        }
        a{
            margin: 0 100px;
        }

        .bg{
            background: #eaf4ed;
        }

        input[type="text"]:focus {
            border-color: #e5a825;
        }

        /* If the screen size is 600px or less, set the font-size of <div> to 30px */
        @media only screen and (max-width: 400px) {
            .title{
                font-size: 20px !important;
            }
            p {
                font-size: 14px !important;
            }
            a{
                margin: 0 !important;
            }
            .navbar{
                justify-content: center;
                display: grid;
            }
        }

        /* If the screen size is 600px or less, set the font-size of <div> to 30px */
        @media only screen and (max-width: 520px) {
            .app-logo{
                height: 50px !important;
                width: auto;
            }

            a{
                margin: 0 !important;
            }
            .navbar{
                justify-content: center;
                display: grid;
            }
        }

        /* If the screen size is 600px or less, set the font-size of <div> to 30px */
        @media only screen and (max-width: 638px) {
            a{
                margin: 0;
            }
            .navbar{
                justify-content: center;
                display: grid;
            }
        }

        @media only screen and (max-width: 767px) {
            .captcha{
                margin-bottom: 1rem;
            }
        }
    </style>
@endpush

@section('content')
    <!-- Image and text -->
    <nav class="navbar navbar-light bg">
        <a class="navbar-brand"
           href="{{ route('main.index') }}">
            <img src="{{getImageFile(get_option('app_logo'))}}"
                 class="d-inline-block align-top app-logo" alt="logo"
                 width="100%" height="100%" style="height: 80px;"></a>

        <a class="btn btn-warning px-5 py-2 default-border" href="{{ route('logout') }}"
           onclick="event.preventDefault();
           document.getElementById('logout-form').submit();">
            {{ __('Logout') }}
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
    </nav>
    <div class="container align-items-center justify-content-center">
        <div class="row justify-content-center align-items-center h-100 mt-5">
            <div class="col-md-6">
                <div class="card card-body bg text-center">
                    <form action="{{ route('verification.send') }}" method="post">
                        @csrf

                        <b class="title mb-1">Send Verification Code</b>
                        <div class="forgot-pass-text mb-25 mt-3">
                            <p class="mb-2 text-muted">Just to Make Sure it's You, <br>Choose the Way You Would Like to Receive the Verification Code:</p>
                        </div>

                        <div class="row mb-3">
                            <input type="hidden" name="user-id" value="{{ auth()->user()->id }}">
                            <div class="col-md-12 p-1 d-flex gap-3 p-2">
                                <input type="radio" name="verify-by" class="form-check-input" value="phone" id="verify-by-phone" autocomplete="off">
                                <label class="form-check-label" for="verify-by-phone">Via Text SMS at:
                                    <span class="font-bold">{{ \Illuminate\Support\Str::mask('+('.auth()->user()->area_code,'*',2,3) }})</span>
                                    <span class="font-bold">{{ \Illuminate\Support\Str::mask(auth()->user()->mobile_number,'*',2,-2) }}</span>
                                </label>
                            </div>
                            <hr class="mt-2 mb-3">
                            <div class="col-md-12 p-1 d-flex gap-3 p-2">
                                <input type="radio" name="verify-by" class="form-check-input" checked value="email" id="verify-by-email" autocomplete="off">
                                <label class="form-check-label" for="verify-by-email">Via Email at: <span class="font-bold">{{ \Illuminate\Support\Str::mask(auth()->user()->email,'*',2,-10) }}</span></label>
                            </div>
                            <hr class="mt-2 mb-3">
                            <x-captcha />
                        </div>
                        <div class="row mb-30">
                            <div class="col-md-12">
                                <button type="submit" class="theme-btn theme-button1 theme-button3 font-15 fw-bold w-100">Send</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
