@extends('layouts.auth')

@push('style')
    <style>
        .otp-input {
            width: 60px;
            height: 70px !important;
            text-align: center;
            font-size: 30px;
            margin: 20px auto;
            padding: 0 !important;
        }

        .navbar-brand{
            margin: 0 100px;
        }

        .btn-logout{
            margin: 0 100px;
        }
        .app-logo{
            border-radius: 0 !important;

        }

        .label-text-title {
            font-size: 20px;
        }

        .title {
            font-size: 24px;
        }

        /*a{*/
        /*    margin: 0 100px;*/
        /*}*/

        .bg{
            background: #eaf4ed;
        }

        input[type="text"]:focus {
            border-color: #e5a825;
        }

        .count {
            padding: 2px 8px;
            font-size: 20px;
            font-weight: bold;
            color: grey;
        }

        #resend[disabled] {
            color: lightgray !important;
        }

        .go-back {
            position: absolute;
            top: 5px;
            left: 15px;
            font-size: 20px !important;
        }

        .go-back span:hover {
            color: black !important;
        }

        /* If the screen size is 600px or less, set the font-size of <div> to 30px */
        @media only screen and (max-width: 400px) {
            .title {
                font-size: 20px !important;
            }

            p {
                font-size: 14px !important;
            }

            .navbar-brand,.btn-logout{
                margin: 0 !important;
            }
            .navbar{
                justify-content: center;
                display: grid;
            }
        }

        @media only screen and (max-width: 1050px) {
            .otp-input {
                width: 50px;
                height: 60px !important;
                text-align: center;
                font-size: 16px;
                margin: 10px auto;
            }
            .details{
                display: block !important;
                text-align: center;
            }
        }


        /* If the screen size is 600px or less, set the font-size of <div> to 30px */
        @media only screen and (max-width: 520px) {
            .otp-input {
                width: 40px;
                height: 50px !important;
                text-align: center;
                font-size: 18px;
                margin: 20px auto;
            }

            .app-logo {
                height: 70px !important;
                width: auto;
            }

            .navbar-brand,.btn-logout{
                margin: 0 !important;
            }
            .navbar{
                justify-content: center;
                display: grid;
            }
        }

        /* If the screen size is 600px or less, set the font-size of <div> to 30px */
        @media only screen and (max-width: 638px) {
            .navbar-brand,.btn-logout{
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

        <a class="btn btn-warning default-border px-5 py-2 btn-logout" href="{{ route('logout') }}"
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
            <div class="col-md-6 col-sm-12">
                <form class="card card-body bg" id="verification-form">
                    @csrf()
                    <div class="row mb-30">
                        <div class="col-md-12 position-relative">
                            <a href="{{ route('verify.login') }}" title="go back" class="go-back">
                                <span class="fas fa-chevron-left fa-lg text-secondary"></span>
                            </a>
                            <label class="label-text-title color-heading font-medium text-center w-100 my-3">
                                <b class="title mb-1">{{ __('Verification Code') }}</b>
                                <p>Enter the Verification Code We Just Sent You:</p>
                            </label>
                            <div class="form-group d-flex mb-0 position-relative">
                                <input type="text" class="form-control otp-input" maxlength="1" id="otp1"
                                       oninput="moveToNext(this, 'otp2')" required>
                                <input type="text" class="form-control otp-input" maxlength="1" id="otp2"
                                       oninput="moveToNext(this, 'otp3')" required>
                                <input type="text" class="form-control otp-input" maxlength="1" id="otp3"
                                       oninput="moveToNext(this, 'otp4')" required>
                                <input type="text" class="form-control otp-input" maxlength="1" id="otp4"
                                       oninput="moveToNext(this, 'otp5')" required>
                                <input type="text" class="form-control otp-input" maxlength="1" id="otp5"
                                       oninput="moveToNext(this, 'otp6')" required>
                                <input type="text" class="form-control otp-input" maxlength="1" id="otp6"
                                       oninput="moveToNext(this, '')" required>
                                <input type="hidden" name="verification_code" id="verification_code" required>
                            </div>
                            @if ($errors->has('verification_code'))
                                <span class="text-danger"><i class="fas fa-exclamation-triangle"></i> {{ $errors->first('verification_code') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="text-center justify-content-center mb-3 d-flex">
                        <x-captcha/>
                    </div>
                    <input type="hidden" name="user-id" value="{{ auth()->user()->id }}">
                    <div class="row mb-30 align-items-center" style="margin: auto 15px;">
                        <div class="col-md-6">
                            <div class="d-flex align-items-center justify-content-start gap-1 details">
                                <label class="m-0 p-2" for="resend">Didn't get a code?</label>
                                <button type="button" id="resend" class="resend text-warning m-0 p-0 fw-bold">
                                    Resend
                                    <i class="fas fa-spinner fa-spin d-none" id="loader"></i>
                                </button>
                                <span class="count"></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <button type="submit" id="verify-btn"
                                    class="theme-btn  theme-button3 font-15 fw-bold w-100 d-flex justify-content-around">
                                Verify
                                <i class="fas fa-spinner fa-spin d-none" id="loader-verify"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>
@endsection

@push('script')
    <script>

        // var $verifyBtn = $('#verify-btn');
        // $verifyBtn.prop('disabled',true);

        var $verifyBtn = $('#verify-btn');
        var $loaderverify = $('#loader-verify');
        var $resendBtn = $('#resend');
        var $captcha = $('#captcha');
        var $count = $('.count');

        count_begin()

        function count_begin() {
            let timing = 60;
            $count.html(timing)
            $resendBtn.prop('disabled', true);
            let myTimer = setInterval(function () {
                --timing;
                $count.html(`00:${timing}`);
                if (timing === 0) {
                    clearInterval(myTimer);
                    $resendBtn.prop('disabled', false);
                }
            }, 1000);
        }

        function moveToNext(current, nextFieldID) {
            if (current.value.length === 1) {
                if (nextFieldID !== '') {
                    document.getElementById(nextFieldID).focus();
                } else {
                    $verifyBtn.addClass('theme-button1')
                    // $verifyBtn.click()
                }
            }
        }

        document.addEventListener('keydown', function (e) {
            const key = e.key;
            if (key === 'Backspace') {
                const currentField = document.activeElement;
                if (currentField.value.length === 0) {
                    const prevFieldID = currentField.previousElementSibling ? currentField.previousElementSibling.id : null;
                    if (prevFieldID) {
                        document.getElementById(prevFieldID).focus();
                    }
                    $verifyBtn.removeClass('theme-button1')
                }
            }
        });

        $verifyBtn.click(function () {
            const otp1 = document.getElementById('otp1').value;
            const otp2 = document.getElementById('otp2').value;
            const otp3 = document.getElementById('otp3').value;
            const otp4 = document.getElementById('otp4').value;
            const otp5 = document.getElementById('otp5').value;
            const otp6 = document.getElementById('otp6').value;

            const verificationCode = otp1 + otp2 + otp3 + otp4 + otp5 + otp6;
            if (otp1 && otp2 && otp3 && otp4 && otp5 && otp6) {
                $('#verification_code').val(verificationCode)
                handleVerify(verificationCode)
            } else {
                swal_alert('<b>please provide full verification code.</b>')
            }
        });

        function handleVerify(verificationCode) {
            $('#verification-form').on('submit', function (e) {
                e.preventDefault();

                var formData = $(this).serialize();
                $.ajax({
                    method: "POST",
                    url: "{{ route('verify.login.post') }}",
                    dataType: 'json',
                    data: formData,
                    beforeSend: function () {
                        // loader
                        $loaderverify.removeClass('d-none')
                        $verifyBtn.prop('disabled', true);
                    },
                    success: function (res) {
                        if (res.status) {
                            // redirect
                            swal_alert(res.message, 'success')
                            window.location.href = "{{ route('main.index') }}"
                            $loaderverify.addClass('d-none')
                            $verifyBtn.prop('disabled', false);
                        } else {
                            // didn't send
                            swal_alert(res.message)
                            $loaderverify.addClass('d-none')
                            $verifyBtn.prop('disabled', false);
                        }
                    }
                }).catch(err => {
                    $loaderverify.addClass('d-none')
                    $verifyBtn.prop('disabled', false);
                    $verifyBtn.text("Verify");
                    console.log('err:',err)
                    swal_alert(err.responseJSON.error)
                })
            })

        }

        $('#resend').click(function () {
            var $button = $(this);
            var $loader = $('#loader');
            $button.prop('disabled', true); // Disable the button

            $.ajax({
                method: "POST",
                url: "{{ route('verification.send') }}",
                dataType: 'json',
                data: {
                    "_token": "{{ csrf_token() }}",
                },
                beforeSend: function () {
                    $loader.removeClass('d-none'); // Show the loader
                },
                success: function (res) {
                    if (res.status) {
                        // code has been send
                        Swal.fire({
                            title: "<b style='padding:12px !important;'>Notification from the Global Education Platform!</b><hr>",
                            showCloseButton: true,
                            showConfirmButton: false,
                            html: res.message,
                            timer: 21000
                        });
                    } else {
                        // didn't send
                        swal_alert(res.message)
                    }
                    $button.prop('disabled', false); // Re-enable the button if there is an error
                    $loader.addClass('d-none'); // Hide the loader
                    count_begin()
                }
            }).catch(err => {
                swal_alert(err.responseJSON.message)
                $button.prop('disabled', false); // Re-enable the button if there is an error
                $loader.addClass('d-none'); // Hide the loader
            })
        });

        function swal_alert(content, type = 'error') {
            Swal.fire({
                icon: type,
                title: "<b style='padding:12px !important;'>Notification from the Global Education Platform!</b><hr>",
                showCloseButton: true,
                showConfirmButton: false,
                html: content,
                timer: 21000
            });
        }
    </script>
@endpush
