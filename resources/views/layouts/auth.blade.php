<!DOCTYPE html>

<html lang="en">

<head>

    <title>{{ get_option('app_name') }} - {{ __(@$title) }}</title>

    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">




    <meta name="title" content="{{ get_option('app_name') }} - {{ __(@$title) }}">

    <meta name="description" content="@if(@$metaData['meta_description']) {!! $metaData['meta_description'] !!} @endif">

    @if(@$metaData['meta_keywords'] AND @$metaData['meta_keywords'])

        <meta name="keywords" content="{!! $metaData['meta_keywords'] !!}">

    @endif

    <meta property="og:type" content="Web Template">

    @if(@$metaData['og_title'])

        <meta property="og:title" content="{!! $metaData['og_title'] !!}">

    @endif

    @if(@$metaData['og_description'] AND @$metaData['og_description'])

        <meta property="og:description" content="{!! @$metaData['og_description'] !!}">

    @endif

    <meta property="og:image" content="{{asset('frontend/assets/img/logo.png')}}">




    <meta name="twitter:image" content="{{asset('frontend/assets/img/logo.png')}}">



    <meta name="msapplication-TileImage" content="{{asset('frontend/assets/img/logo.png')}}">



    <meta name="msapplication-TileColor" content="rgba(103, 20, 222,.55)">

    <meta name="theme-color" content="#754FFE">

    <script src="https://www.google.com/recaptcha/api.js?render={{ get_option('recaptcha_site_key', "") }}"></script>





    <!--=======================================

      All Css Style link

    ===========================================-->



    <!-- Bootstrap core CSS -->

    <link href="{{asset('frontend/assets/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">



    <link href="{{asset('frontend/assets/css/jquery-ui.min.css')}}" rel="stylesheet">



    <!-- Font Awesome for this template -->

    <link href="{{asset('frontend/assets/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">

    <link href="{{ asset('frontend/assets/vendor/intl-tel-input/css/intlTelInput.css') }}" rel="stylesheet">
    <!-- Custom fonts for this template -->

    <link rel="preconnect" href="https://fonts.googleapis.com">

    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    @if(get_option('app_font_design_type') == 2)

        @if(empty(get_option('app_font_link')))

            <link href="https://fonts.googleapis.com/css2?family=Jost:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

        @else

            {!! get_option('app_font_link') !!}

        @endif

    @else

        <link href="https://fonts.googleapis.com/css2?family=Jost:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    @endif

    <link rel="stylesheet" href="{{asset('frontend/assets/fonts/feather/feather.css')}}">



    <!-- Animate Css-->

    <link rel="stylesheet" href="{{asset('frontend/assets/css/animate.min.css')}}">



    <link rel="stylesheet" href="{{asset('frontend/assets/css/owl.carousel.min.css')}}">

    <link rel="stylesheet" href="{{asset('frontend/assets/css/owl.theme.default.min.css')}}">



    <link rel="stylesheet" href="{{asset('frontend/assets/css/venobox.min.css')}}">



    @stack('style')

    @toastr_css

    @include('frontend.layouts.dynamic-style')

    <!-- Custom styles for this template -->

    <link href="{{asset('frontend/assets/css/style.css')}}" rel="stylesheet">

    <link href="{{ asset('frontend/assets/css/extra.css') }}" rel="stylesheet">



    <!-- Responsive Css-->

    <link rel="stylesheet" href="{{asset('frontend/assets/css/responsive.css')}}">



    <!-- FAVICONS -->

    <link rel="icon" href="{{ getImageFile(get_option('app_fav_icon')) }}" type="image/png" sizes="16x16">

    <link rel="shortcut icon" href="{{ getImageFile(get_option('app_fav_icon')) }}" type="image/x-icon">

    <link rel="shortcut icon" href="{{ getImageFile(get_option('app_fav_icon')) }}">



    <link rel="apple-touch-icon-precomposed" type="image/x-icon" href="{{asset('frontend/assets/img/apple-icon-72x72.png')}}" sizes="72x72" >

    <link rel="apple-touch-icon-precomposed" type="image/x-icon" href="{{asset('frontend/assets/img/apple-icon-114x114.png')}}" sizes="114x114" >

    <link rel="apple-touch-icon-precomposed" type="image/x-icon" href="{{asset('frontend/assets/img/apple-icon-144x144.png')}}" sizes="144x144" >

    <link rel="apple-touch-icon-precomposed" type="image/x-icon" href="{{asset('frontend/assets/img/favicon-16x16.png')}}" >



    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->

    <!--[if lt IE 9]>

    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>

    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>


    <![endif]-->

    <!-- Sweet Alert css -->
    <link rel="stylesheet" href="{{asset('admin/sweetalert2/sweetalert2.css')}}">

    <script src="https://www.google.com/recaptcha/api.js?render={{ get_option('recaptcha_site_key', "") }}"></script>



    <!-- Google tag (gtag.js) -->

    <script async src="https://www.googletagmanager.com/gtag/js?id={{ get_option('measurement_id') }}"></script>

    <script>

        window.dataLayer = window.dataLayer || [];

        function gtag(){dataLayer.push(arguments);}

        gtag('js', new Date());



        gtag('config', "{{ get_option('measurement_id') }}");

    </script>

    <style>
        .swal2-popup, .swal2-modal, .swal2-confirm{
            border-radius: 33px !important;
        }
        .swal2-html-container p{
            line-height: 30px;
        }
        .spinner {
            display: block;
            width: 200px;
            position: absolute;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
            font-family: Montserrat, serif !important;
        }
        .custom_border{
            border-radius: 33px !important;
        }
        .iti #register_phone_code{
            padding-left: 0!important;
            visibility: hidden;
            opacity: 0;
        }
        .iti .iti__flag-container {
            width: 100%;
        }
        .iti.iti--allow-dropdown {
            width: 100%;
        }
        .iti .iti__selected-flag {
            padding: 0 0.75rem 0 0.5rem;
            border-radius: 30px;
            width: 100%;
            border: 1px solid #dae1e7;
            justify-content: start;
        }
        .iti .iti__selected-flag {
            border: 2px solid #ebf0f7;
        }
        .iti .iti__country-list .iti__flag {
            border-radius: 30px;
        }
        .iti .iti__selected-dial-code {
            color: #5e6d77;
        }
        .iti .iti__arrow {
            margin-left: auto;
        }
        .iti.iti--separate-dial-code .iti__selected-flag {
            background-color: rgb(255 255 255);
        }
        .iti.iti--allow-dropdown .iti__flag-container:hover .iti__selected-flag {
            background-color: rgb(255 255 255);
        }
        .iti .iti__selected-flag .iti__flag {
            border-radius: 10px;
        }
        .iti.iti--allow-dropdown input, .iti--allow-dropdown input[type=text], .iti--allow-dropdown input[type=tel], .iti--separate-dial-code input, .iti--separate-dial-code input[type=text], .iti--separate-dial-code input[type=tel] {
            padding-left: 3.6rem;
        }
       .iti .iti__flag-container ::-webkit-scrollbar-track {
            -webkit-box-shadow: inset 0 0 5px  #adaaaa;
            border-radius: 8px;
            background-color: #F5F5F5;
        }
        .iti .iti__flag-container ::-webkit-scrollbar {
            width: 10px;
        }
        .iti .iti__flag-container ::-webkit-scrollbar-thumb {
            border-radius: 10px;
            -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,.3);
            background-color: #afb0b3;
        }
        .iti .iti__country-list {
            box-shadow: -2px 2px 10px rgb(0 0 0 / 24%), 1px 7px 10px rgb(0 0 0 / 24%);
            border: 0;
            margin-top: 10px;
            border-top-left-radius: 30px;
            border-top-right-radius: 8px;
            border-bottom-right-radius: 8px;
            border-bottom-left-radius: 30px;
            padding-top: 0;
            padding-bottom: 10px;
            min-height: 250px;
            min-width: 380px;
        }
        .iti .iti__selected-flag {
            border-radius: 0;
        }
        .iti .iti__country-list .form-control,
        .iti .iti__country-list .form-control,
        .iti .iti__country-list .form-group .form-control{
            padding: 10px 16px 10px 43px;
            height: 45px;
            width: 100%;
            border: 0;
            border-radius: 0;
        }
        .iti .iti__country-list .form-group,
        .iti .iti__country-list .form-group,
        .iti .iti__country-list .form-group {
            margin: 0;
        }
        .iti .iti__country-list .form-group .input-icon {
            position: absolute;
            top: 22px;
            left: 15px;
            font-size: 20px;
            transform: translateY(-50%);
            color: #acb5be;
            line-height: 0
        }

        .swal2-close{
            border-right: 33px;
            border: none !important;
        }

    </style>

</head>



<body class="{{selectedLanguage()->rtl == 1 ? 'direction-rtl' : 'direction-ltr' }}">



@if(get_option('allow_preloader') == 1)

    <!-- Pre Loader Area start -->

    <div id="preloader">

        <div id="preloader_status"><img src="{{getImageFile(get_option('app_preloader'))}}" alt="img" /></div>

    </div>

    <!-- Pre Loader Area End -->

@endif


<?php
session_start();

$sessionTimeout = 60000000;
if(isset($_SESSION["last_activity"])){
    if((time() - $_SESSION["last_activity"]) > $sessionTimeout){
        session_destroy();
    }
}

if (!isset($_SESSION["logged_in"]) || $_SESSION["logged_in"] !== true) {

    ?>


<button type="button" id="openModal" class="btn btn-primary d-none" data-bs-toggle="modal" data-bs-target="#exampleModal">asdfsd</button>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Log In</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{ route('frontend.secure.login.auth') }}">
                    @csrf
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Password:</label>
                        <input type="password" name="password" class="form-control" id="recipient-name">
                    </div>
                    <div class="form-group mt-3">
                        <button type="submit" style="padding: 8px 15px;" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>

    window.onload = function() {
        // Your code here
        openModal();
    };

    function openModal(){
        document.getElementById('openModal').click();
    }
</script>
<?php }else{ ?>

@yield('content')

<?php } ?>


<!--=======================================

    All Jquery Script link

===========================================-->

<!-- Bootstrap core JavaScript -->

<script src="{{asset('frontend/assets/vendor/jquery/jquery-3.6.0.min.js')}}"></script>

<script src="{{asset('frontend/assets/vendor/jquery/popper.min.js')}}"></script>

<script src="{{asset('frontend/assets/vendor/bootstrap/js/bootstrap.min.js')}}"></script>



<!-- ==== Plugin JavaScript ==== -->

<script src="{{asset('frontend/assets/vendor/jquery-easing/jquery.easing.min.js')}}"></script>



<script src="{{asset('frontend/assets/js/jquery-ui.min.js')}}"></script>



<!--WayPoints JS Script-->

<script src="{{asset('frontend/assets/js/waypoints.min.js')}}"></script>



<!--Counter Up JS Script-->

<script src="{{asset('frontend/assets/js/jquery.counterup.min.js')}}"></script>



<script src="{{asset('frontend/assets/js/owl.carousel.min.js')}}"></script>



<!-- Range Slider -->

<script src="{{asset('frontend/assets/js/price_range_script.js')}}"></script>



<!--Feather Icon-->

<script src="{{asset('frontend/assets/js/feather.min.js')}}"></script>



<!--Iconify Icon-->

<script src="{{ asset('common/js/iconify.min.js') }}"></script>



<!--Venobox-->

<script src="{{asset('frontend/assets/js/venobox.min.js')}}"></script>



<!-- Menu js -->

<script src="{{asset('frontend/assets/js/menu.js')}}"></script>
<script src="{{ asset('frontend/assets/vendor/intl-tel-input/js/intlTelInput.min.js') }}"></script>
<!-- <script>
  const input = document.querySelector("#mobile_number");
  var iti = window.intlTelInput(input, {
    utilsScript: "https://cdn.jsdelivr.net/npm/intl-tel-input@18.2.1/build/js/utils.js",
    separateDialCode : true,
  });

  input.addEventListener("focus", function() {
    var countryCode = iti.getSelectedCountryData().dialCode;
    $('#countryCode').val('+'+countryCode);
  });

</script> -->


<script>
     function selectCountryForPhone(countryCode) {
        if($('#register_phone_country') && $('#register_phone_country').val()) {
            var initial_country = $('#register_phone_country').val();
        } else {
            var initial_country = countryCode;
        }
        if($('input[name="phone_code"]') && $('input[name="phone_code"]').val()) {
            var initial_code = $('input[name="phone_code"]').val();
        } else {
            var initial_code = '1';
        }
        var phoneInputID = '#register_phone_code';
        var input = document.querySelector(phoneInputID);
        var iti = window.intlTelInput(input, {
            separateDialCode: true,
            formatOnDisplay: true,
            hiddenInput: "full_phone",
            preferredCountries: [initial_country],
            utilsScript: "{{ asset('frontend/assets/vendor/intl-tel-input/js/utils.js') }}"
        });
        $('#register_phone_code').val(initial_code);
        $('#register_hidden_phone_code').val(initial_code);
        $('#register_phone_country').val(initial_country);
        $(phoneInputID).on("countrychange", function(event) {
            var selectedCountryData = iti.getSelectedCountryData();

            $('#register_phone_code').val(selectedCountryData.dialCode);
            $('#register_hidden_phone_code').val(selectedCountryData.dialCode);
            $('#register_phone_country').val(selectedCountryData.iso2);
        });
        $(phoneInputID).trigger('countrychange');
        $(phoneInputID).on("open:countrydropdown", function(event) {
            var $list = $(phoneInputID).closest('.iti').find('.iti__country-list');
            if(!$list.find('input[name="search_country"]').length) {
                var $search_group = $(
                    '<div class="form-group">'
                        +'<input type="text" name="search_country" placeholder="Country Search" autocomplete="off" class="form-control">'
                        +'<i class="input-icon field-icon icofont-search-2"></i>'
                    +'</div>'
                ).prependTo($list);
                var $search = $search_group.find('input');
                $search.on('click', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                });
                $search.on('keyup', function(e) {
                    e.stopPropagation();
                    var str = $(this).val().toLowerCase();
                    $list.find('.iti__country').each(function (index, el) {
                        var $el = $(el);
                        if(!str) {
                            $el.show();
                        } else {
                            var found_by_name = $el.find('.iti__country-name').text().toLowerCase().indexOf(str);
                            var found_by_code = $el.find('.iti__dial-code').text().toLowerCase().indexOf(str);
                            if(found_by_name == -1 && found_by_code == -1) {
                                $el.hide();
                            } else {
                                $el.show();
                            }
                        }
                    });
                });
                $search.on('keydown', function(e) {
                    e.stopPropagation();
                });
            }
        });
    }


    function getUserCountryByIP() {
        if($('#register_phone_code').length) {
            $.get('https://ipinfo.io', function() {}, "jsonp").always(function(resp) {
                var countryCode = (resp && resp.country) ? resp.country.toLowerCase() : "us";
                if($('#register_phone_code').length) {
                    selectCountryForPhone(countryCode);
                }
            });
        }
    }
    getUserCountryByIP();
</script>



@stack('script')

<script>

    var deleteTitle = '{{ __("Sure! You want to delete?") }}';

    var deleteText = '{{ __("You wont be able to revert this!") }}';

    var deleteConfirmButton = '{{ __("Yes, Delete It!") }}';

    var deleteSuccessText = '{{ __("Item has been deleted") }}';

</script>



@toastr_js

@toastr_render

<!-- Custom scripts for this template -->

<script src="{{asset('frontend/assets/js/frontend-custom.js')}}"></script>
<script src="{{asset('admin/sweetalert2/sweetalert2.all.js')}}"></script>
@if(session()->has('basic'))
    <script>
        Swal.fire({
            title: "<b style='padding:12px !important;'>Notification from the Global Education Platform!</b><hr>",
            showCloseButton:true,
            showConfirmButton: false,
            html: "{!!  session('basic') !!}",
            timer: 21000
        });
    </script>
@endif

@if(session()->has('error'))
    <script>
        Swal.fire({
            icon: "error",
            title: "<b style='padding:12px !important;'>Notification from the Global Education Platform!</b><hr>",
            html: "{!! session('error')  !!}",
            showCloseButton:true,
            showConfirmButton: false,
            timer: 21000
        });
    </script>
@endif

@if(session()->has('success'))
    <script>
        Swal.fire({
            title: "<b style='padding:12px !important;'>Notification from the Global Education Platform!</b><hr>",
            html: "{!! session('success') !!}",
            showCloseButton:true,
            showConfirmButton: false,
            timer: 21000
        });
    </script>
@endif

@if(session()->has('warning'))
    <script>
        Swal.fire({
            icon: "warning",
            title: "<b style='padding:12px !important;'>Notification from the Global Education Platform!</b><hr>",
            html: "{!! session('warning')  !!}",
            showCloseButton:true,
            showConfirmButton: false,
            timer: 21000
        });
    </script>
@endif

@error('captcha')
<script>
    Swal.fire({
        icon: "error",
        title: "<b style='padding:12px !important;'>Notification from the Global Education Platform!</b><hr>",
        html: "<b class='text-danger'>Unfortunately, You Entered an Incorrect CAPTCHA!</b><p>Please, Update the CAPTCHA Try Again!</p><b><i>Best Regards!</i></b>",
        showCloseButton:true,
        showConfirmButton: false,
        timer: 21000
    });
</script>
@enderror

</body>



</html>

