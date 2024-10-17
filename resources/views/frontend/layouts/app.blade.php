<!DOCTYPE html>

<html lang="en">



<head>



    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">



    {{--    <title> @if (@$metaData['meta_title'] != '') {{ @$metaData['meta_title'] }} @else {{ @$pageTitle }} @endif </title> --}}



    <meta name="description" content="@if (@$metaData['meta_description'] != '') {{ @$metaData['meta_description'] }} @endif">

    @if (isset($metaData['meta_keyword']) and $metaData['meta_keyword'] != null)
        <meta name="keywords" content="{{ $metaData['meta_keyword'] }}">
    @endif





    <meta name="csrf-token" content="{{ csrf_token() }}">



    <meta property="og:type" content="Learning">

    <meta property="og:title" content="{{ get_option('og_title') }}">

    <meta property="og:description" content="{{ get_option('og_description') }}">

    <meta property="og:image" content="{{ getImageFile(get_option('app_logo')) }}">



    <meta name="twitter:card" content="Learning">

    <meta name="twitter:title" content="{{ get_option('og_title') }}">

    <meta name="twitter:description" content="{{ get_option('og_description') }}">

    <meta name="twitter:image" content="{{ getImageFile(get_option('app_logo')) }}">



    <meta name="msapplication-TileImage" content="{{ getImageFile(get_option('app_logo')) }}">



    <meta name="msapplication-TileColor" content="rgba(103, 20, 222,.55)">

    <meta name="theme-color" content="#754FFE">



    @yield('meta')



    <title>{{ get_option('app_name') }} - {{ __(@$pageTitle) }}</title>



    <!--=======================================

      All Css Style link

    ===========================================-->



    <!-- Bootstrap core CSS -->

    <link href="{{ asset('frontend/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.3/css/bootstrap.min.css" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.css" />

    <link href="{{ asset('frontend/assets/css/jquery-ui.min.css') }}" rel="stylesheet">



    <!-- Font Awesome for this template -->

    <link href="{{ asset('frontend/assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet"
        type="text/css">
    <link href="{{ asset('frontend/assets/vendor/intl-tel-input/css/intlTelInput.css') }}" rel="stylesheet">
    <!--<link href="{{ asset('frontend/assets/vendor/cropper/css/cropper.css') }}" rel="stylesheet">-->


    <!-- Custom fonts for this template -->

    <link rel="preconnect" href="https://fonts.googleapis.com">

    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    @if (get_option('app_font_design_type') == 2)

        @if (empty(get_option('app_font_link')))
            <link
                href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
                rel="stylesheet">
        @else
            {!! get_option('app_font_link') !!}
        @endif
    @else
        <link
            href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
            rel="stylesheet">

    @endif

    <link rel="stylesheet" href="{{ asset('frontend/assets/fonts/feather/feather.css') }}">





    <link rel="stylesheet" href="{{ asset('frontend/assets/css/owl.carousel.min.css') }}">

    <link rel="stylesheet" href="{{ asset('frontend/assets/css/owl.theme.default.min.css') }}">



    <link rel="stylesheet" href="{{ asset('frontend/assets/css/venobox.min.css') }}">






    <!-- Custom styles for this template -->

    <link href="{{ asset('frontend/assets/css/style.css') }}" rel="stylesheet">

    <link href="{{ asset('frontend/assets/css/extra.css') }}" rel="stylesheet">



    <!-- Responsive Css-->

    <link rel="stylesheet" href="{{ asset('frontend/assets/css/responsive.css') }}">



    <!-- FAVICONS -->

    <link rel="icon" href="{{ getImageFile(get_option('app_fav_icon')) }}" type="image/png" sizes="16x16">

    <link rel="shortcut icon" href="{{ getImageFile(get_option('app_fav_icon')) }}" type="image/x-icon">

    <link rel="shortcut icon" href="{{ getImageFile(get_option('app_fav_icon')) }}">



    <link rel="apple-touch-icon-precomposed" type="image/x-icon" href="{{ getImageFile(get_option('app_fav_icon')) }}"
        sizes="72x72">

    <link rel="apple-touch-icon-precomposed" type="image/x-icon" href="{{ getImageFile(get_option('app_fav_icon')) }}"
        sizes="114x114">

    <link rel="apple-touch-icon-precomposed" type="image/x-icon" href="{{ getImageFile(get_option('app_fav_icon')) }}"
        sizes="144x144">

    <link rel="apple-touch-icon-precomposed" type="image/x-icon" href="{{ getImageFile(get_option('app_fav_icon')) }}">



    <!-- DataTables -->

    <link rel="stylesheet"
        href="{{ asset('frontend/assets/vendor/datatable/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">

    <link rel="stylesheet"
        href="{{ asset('frontend/assets/vendor/datatable/datatables-responsive/css/responsive.bootstrap4.min.css') }}">

    <link rel="stylesheet"
        href="{{ asset('frontend/assets/vendor/datatable/datatables-buttons/css/buttons.bootstrap4.min.css') }}">

    <style>
        .iti #register_phone_code {
            padding-left: 0 !important;
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

        .iti.iti--allow-dropdown input,
        .iti--allow-dropdown input[type=text],
        .iti--allow-dropdown input[type=tel],
        .iti--separate-dial-code input,
        .iti--separate-dial-code input[type=text],
        .iti--separate-dial-code input[type=tel] {
            padding-left: 3.6rem;
        }

        .iti .iti__flag-container ::-webkit-scrollbar-track {
            -webkit-box-shadow: inset 0 0 5px #adaaaa;
            border-radius: 8px;
            background-color: #F5F5F5;
        }

        .iti .iti__flag-container ::-webkit-scrollbar {
            width: 10px;
        }

        .iti .iti__flag-container ::-webkit-scrollbar-thumb {
            border-radius: 10px;
            -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, .3);
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
            border-radius: 33px;
        }

        .iti .iti__country-list .form-control,
        .iti .iti__country-list .form-control,
        .iti .iti__country-list .form-group .form-control {
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

        .swal2-popup,
        .swal2-confirm {
            border-radius: 33px !important;
        }

        .swal2-html-container p {
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
    </style>



    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->

    <!--[if lt IE 9]>

    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>

    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>

    <![endif]-->



    @stack('style')

    @toastr_css

    @include('frontend.layouts.dynamic-style')




    @if (get_option('pwa_enable'))
        <!-- PWA  -->

        <meta name="theme-color"
            content="{{ empty(get_option('app_theme_color')) ? '#5e3fd7' : get_option('app_theme_color') }}" />

        <link rel="apple-touch-icon" href="{{ getImageFile(get_option('app_fav_icon')) }}">

        <link rel="manifest" href="{{ asset('manifest.json') }}">
    @endif

    @if (isEnableOpenAI())
        <link rel="stylesheet" href="{{ asset('addon/AI/css/main.css') }}">
    @endif



    <!-- Animate Css-->
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/animate.min.css') }}">

    <!-- Sweet Alert css -->

    <link rel="stylesheet" href="{{ asset('admin/sweetalert2/sweetalert2.css') }}">


    <script async src="https://www.googletagmanager.com/gtag/js?id={{ get_option('measurement_id') }}"></script>

    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }

        gtag('js', new Date());



        gtag('config', "{{ get_option('measurement_id') }}");
    </script>



</head>



@php

    $selectedLanguage = selectedLanguage();

@endphp



<body class="{{ $selectedLanguage->rtl == 1 ? 'direction-rtl' : 'direction-ltr' }}">



    @if (get_option('allow_preloader') == 1)
        <!-- Pre Loader Area start -->

        <div id="preloader">

            <div id="preloader_status"><img src="{{ getImageFile(get_option('app_preloader')) }}" alt="img" />
            </div>

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


    <button type="button" id="openModal" class="btn btn-primary d-none" data-bs-toggle="modal"
        data-bs-target="#exampleModal">asdfsd</button>

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Log In</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ route('frontend.secure.login') }}">
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

        function openModal() {
            document.getElementById('openModal').click();
        }
    </script>
    <?php }else{ ?>
    <!--Main Menu/Navbar Area Start -->

    @include('frontend.layouts.navbar')

    <!--Main Menu/Navbar Area Start -->



    <!-- Main Content Start-->

    @yield('content')

    <!-- Main Content End-->



    <!-- Footer Start -->

    @include('frontend.layouts.footer')

    <!-- Footer End -->

    <?php } ?>





    <!-- PWA Install Button Start -->

    <button class="d-none pwa-install-btn bg-white position-fixed radius-4" id="installApp">

        <img style="height: 40px;" src="{{ asset(get_option('app_pwa_icon')) }}" alt="Our categories">

    </button>

    <!-- PWA Install Button End -->


    <script>
        var deleteTitle = '{{ __('Sure! You want to delete?') }}';

        var deleteText = '{{ __('You wont be able to revert this!') }}';

        var deleteConfirmButton = '{{ __('Yes, Delete It!') }}';

        var deleteSuccessText = '{{ __('Item has been deleted') }}';
    </script>

    <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.js"></script>-->
    <!--  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>-->
    <!--  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.3/js/bootstrap.min.js"></script>-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.js"></script>
    <!--=======================================

    All Jquery Script link

===========================================-->

    <!-- Bootstrap core JavaScript -->

    <script src="{{ asset('frontend/assets/vendor/jquery/jquery-3.6.0.min.js') }}"></script>

    <script src="{{ asset('frontend/assets/vendor/jquery/popper.min.js') }}"></script>

    <script src="{{ asset('frontend/assets/vendor/bootstrap/js/bootstrap.min.js') }}"></script>



    <!-- ==== Plugin JavaScript ==== -->

    <script src="{{ asset('frontend/assets/vendor/jquery-easing/jquery.easing.min.js') }}"></script>



    <script src="{{ asset('frontend/assets/js/jquery-ui.min.js') }}"></script>



    <!--WayPoints JS Script-->

    <script src="{{ asset('frontend/assets/js/waypoints.min.js') }}"></script>



    <!--Counter Up JS Script-->

    <script src="{{ asset('frontend/assets/js/jquery.counterup.min.js') }}"></script>



    <script src="{{ asset('frontend/assets/js/owl.carousel.min.js') }}"></script>



    <!-- Range Slider -->

    <script src="{{ asset('frontend/assets/js/price_range_script.js') }}"></script>



    <!--Feather Icon-->

    <script src="{{ asset('frontend/assets/js/feather.min.js') }}"></script>



    <!--Iconify Icon-->

    <script src="{{ asset('common/js/iconify.min.js') }}"></script>



    <!--Venobox-->

    <script src="{{ asset('frontend/assets/js/venobox.min.js') }}"></script>



    <!-- Menu js -->

    <script src="{{ asset('frontend/assets/js/menu.js') }}"></script>



    <!-- Custom scripts for this template -->

    <script src="{{ asset('frontend/assets/js/frontend-custom.js') }}"></script>

    <script src="{{ asset('admin/sweetalert2/sweetalert2.all.js') }}"></script>

    <input type="hidden" id="base_url" value="{{ url('/') }}">

    <!-- Start:: Navbar Search  -->

    <input type="hidden" class="search_route" value="{{ route('search-course.list') }}">

    <script src="{{ asset('frontend/assets/js/custom/search-course.js') }}"></script>

    <!-- End:: Navbar Search  -->

    <script>
        function getLanguage() {

            return {

                "sEmptyTable": "{{ __('No data available in table') }}",

                "sInfo": "{{ __('Showing _START_ To _END_ Of _TOTAL_ Entries') }}",

                "sInfoEmpty": "{{ __('Showing 0 to 0 of 0 entries') }}",

                "sInfoFiltered": "{{ __('(filtered from _MAX_ total entries)') }}",

                "sInfoPostFix": "",

                "sInfoThousands": ",",

                "sLengthMenu": "{{ __('Show _MENU_ entries') }}",

                "sLoadingRecords": "{{ __('Loading...') }}",

                "sProcessing": "{{ __('Processing...') }}",

                "sSearch": "{{ __('Search:') }}",

                "sZeroRecords": "{{ __('No matching records found') }}",

                "oPaginate": {

                    "sFirst": "{{ __('First') }}",

                    "sLast": "{{ __('Last') }}",

                    "sNext": "{{ __('Next') }}",

                    "sPrevious": "{{ __('Previous') }}"

                },

                "oAria": {

                    "sSortAscending": ": {{ __('activate to sort column ascending') }}",

                    "sSortDescending": ": {{ __('activate to sort column descending') }}"

                }

            };

        }
    </script>

    <!-- DataTables  & Plugins -->

    <script src="{{ asset('frontend/assets/vendor/datatable/datatables/jquery.dataTables.min.js') }}"></script>

    <script src="{{ asset('frontend/assets/vendor/datatable/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>

    <script src="{{ asset('frontend/assets/vendor/datatable/datatables-responsive/js/dataTables.responsive.min.js') }}">
    </script>

    <script src="{{ asset('frontend/assets/vendor/datatable/datatables-responsive/js/responsive.bootstrap4.min.js') }}">
    </script>

    <script src="{{ asset('frontend/assets/vendor/datatable/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>

    <script src="{{ asset('frontend/assets/vendor/datatable/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>

    <script src="{{ asset('frontend/assets/vendor/datatable/jszip/jszip.min.js') }}"></script>

    <script src="{{ asset('frontend/assets/vendor/datatable/pdfmake/pdfmake.min.js') }}"></script>

    <script src="{{ asset('frontend/assets/vendor/datatable/pdfmake/vfs_fonts.js') }}"></script>

    <script src="{{ asset('frontend/assets/vendor/datatable/datatables-buttons/js/buttons.html5.min.js') }}"></script>

    <script src="{{ asset('frontend/assets/vendor/datatable/datatables-buttons/js/buttons.print.min.js') }}"></script>

    <script src="{{ asset('frontend/assets/vendor/datatable/datatables-buttons/js/buttons.colVis.min.js') }}"></script>

    <script src="{{ asset('frontend/assets/vendor/intl-tel-input/js/intlTelInput.min.js') }}"></script>
    <!--<script src="{{ asset('frontend/assets/vendor/cropper/js/cropper.js') }}"></script>-->


    <!-- <script>
        // Send an AJAX request when the browser tab is being closed
        window.addEventListener("beforeunload", function() {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                type: 'POST',
                url: '{{ route('frontend.secure.logout') }}',
                success: function(data) {

                },
                error: function(e) {
                    console.log(e);
                }
            });
        });
    </script> -->


    @if (isEnableOpenAI())
        <script src="{{ asset('addon/AI/js/main.js') }}"></script>
    @endif



    @stack('script')



    @toastr_js

    @toastr_render



    @if (@$errors->any())
        <script>
            "use strict";

            @foreach ($errors->all() as $error)

                toastr.options.positionClass = 'toast-bottom-right';

                toastr.error("{{ $error }}")
            @endforeach
        </script>
    @endif


    <?php if (!isset($_SESSION["logged_in"]) || $_SESSION["logged_in"] !== true) { ?>

    <style>
        .js-cookie-consent {
            display: none;
        }
    </style>
    <script>
        function myGreeting() {
            $('.js-cookie-consent').hide();
        }

        setTimeout(myGreeting, 2000);
    </script>

    <?php }else{  ?>


    @if (get_option('pwa_enable'))
        <script src="{{ asset('sw.js') }}"></script>

        <script>
            if (!navigator.serviceWorker.controller) {

                navigator.serviceWorker.register("/sw.js").then(function(reg) {

                    console.log("Service worker has been registered for scope: " + reg.scope);

                });

            }



            let deferredPrompt;

            window.addEventListener('beforeinstallprompt', (e) => {

                $('#installApp').removeClass('d-none');

                deferredPrompt = e;

            });



            const installApp = document.getElementById('installApp');

            installApp.addEventListener('click', async () => {

                if (deferredPrompt !== null) {

                    deferredPrompt.prompt();

                    const {
                        outcome
                    } = await deferredPrompt.userChoice;

                    if (outcome === 'accepted') {

                        deferredPrompt = null;

                    }

                }

            });
        </script>
    @endif

    <?php }?>

    @if (session()->has('success'))
        <script>
            Swal.fire({
                title: "<b style='padding:12px !important;'>Notification from the Global Education Platform!</b><hr>",
                html: "{!! session('success') !!}",
                showCloseButton: true,
                showConfirmButton: false,
                timer: 21000,
                focusConfirm: false,
            });
        </script>
    @endif


</body>



</html>
