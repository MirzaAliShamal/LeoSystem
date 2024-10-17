<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ __(@$title) }}</title>



    <!-- Favicon included -->

    <link rel="shortcut icon" href="{{getImageFile(get_option('app_fav_icon'))}}" type="image/x-icon">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Apple touch icon included -->

    <link rel="apple-touch-icon" href="{{getImageFile(get_option('app_fav_icon'))}}">



    <link rel="stylesheet" href="{{asset('admin/sweetalert2/sweetalert2.css')}}">



    <!-- All CSS files included here -->

    <link rel="stylesheet" href="{{asset('admin/css/all.min.css')}}">

    <link rel="stylesheet" href="{{ asset('frontend/assets/vendor/bootstrap/css/bootstrap.min.css') }}">

    @stack('style')
    
 

    <link rel="stylesheet" href="{{asset('admin/css/metisMenu.min.css')}}">

    <link rel="stylesheet" href="{{asset('admin/styles/main.css')}}">

    <link rel="stylesheet" href="{{asset('admin/css/admin-extra.css')}}">

    <link href="{{asset('common/css/select2.css')}}" rel="stylesheet">
    <link href="{{ asset('frontend/assets/vendor/intl-tel-input/css/intlTelInput.css') }}" rel="stylesheet">

    <style>
    .iti.iti--allow-dropdown.iti--show-flags{
        width: 100%;
    }
 
    .iti--separate-dial-code .iti__selected-flag{
        background-color: transparent; 
        border-radius: 33px;
    }

    .iti--allow-dropdown .iti__flag-container:hover .iti__selected-flag{
        background-color: transparent; 
    }
</style> 
 
<style>
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
            border-radius: 33px;
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
    </style>
 

    @if(isEnableOpenAI())

    <link rel="stylesheet" href="{{asset('addon/AI/css/main.css')}}">

    @endif



    @toastr_css



    @if(!empty(get_option('certificate_regular')) && get_option('certificate_regular') != '' )

    <style>

        .certificateFont {

            @font-face {

                font-family: "certificateFont";

                url: {{ asset(get_option('certificate_font')) }},

            }

        }

    </style>

    @endif

    

</head>

<body class=" {{selectedLanguage()->rtl == 1 ? 'direction-rtl' : 'direction-ltr' }} ">



@if(get_option('allow_preloader') == 1)

    <!-- Pre Loader Area start -->

    <div id="preloader">

        <div id="preloader_status"><img src="{{getImageFile(get_option('app_preloader'))}}" alt="img" /></div>

    </div>

    <!-- Pre Loader Area End -->

@endif



<!-- Sidebar area start -->

@include('admin.common.sidebar')

<!-- Sidebar area end -->



<!-- Main Content area start -->

<div class="main-content">



    <!-- Header section start -->

    @include('admin.common.header')

    <!-- Header section end -->



    <!-- page content wrap start -->

    <div class="page-content-wrap">

        <!-- Page content area start -->

        @yield('content')

        <!-- Page content area end -->



        <!-- Footer section start -->

        @include('admin.common.footer')

        <!-- Footer section end -->

    </div>

    <!-- page content wrap end -->



    @if(isEnableOpenAI()) 

        @include('addon.AI.content-generation')

    @endif



</div>

<!-- Main Content area end -->

<script>

    var deleteTitle = '{{ __("Sure! You want to delete?") }}';

    var deleteText = '{{ __("You wont be able to revert this!") }}';

    var deleteConfirmButton = '{{ __("Yes, Delete It!") }}';

    var deleteSuccessText = '{{ __("Item has been deleted") }}';

    function getLanguage(){

        return {

            "sEmptyTable": "{{ __('No data available in table') }}",

            "sInfo": "{{__('Showing _START_ To _END_ Of _TOTAL_ Entries')}}",

            "sInfoEmpty": "{{__('Showing 0 to 0 of 0 entries')}}",

            "sInfoFiltered": "{{__('(filtered from _MAX_ total entries)')}}",

            "sInfoPostFix": "",

            "sInfoThousands": ",",

            "sLengthMenu": "{{__('Show _MENU_ entries')}}",

            "sLoadingRecords": "{{__('Loading...')}}",

            "sProcessing": "{{__('Processing...')}}",

            "sSearch": "{{__('Search:')}}",

            "sZeroRecords": "{{__('No matching records found')}}",

            "oPaginate": {

                "sFirst": "{{__('First')}}",

                "sLast": "{{__('Last')}}",

                "sNext": "{{__('Next')}}",

                "sPrevious": "{{__('Previous')}}"

            },

            "oAria": {

                "sSortAscending": ": {{__('activate to sort column ascending')}}",

                "sSortDescending": ": {{__('activate to sort column descending')}}"

            }

        };

    }

</script>

<input type="hidden" id="base_url" value="{{url('/')}}">



<!-- All Javascript files included here -->

<script src="{{asset('frontend/assets/vendor/jquery/jquery-3.6.0.min.js')}}"></script>

<script src="{{asset('admin/js/popper.min.js')}}"></script>

<script src="{{ asset('frontend/assets/vendor/bootstrap/js/bootstrap.min.js') }}"></script>

<script src="{{asset('common/js/apexcharts.min.js')}}"></script>

<script src="{{asset('admin/sweetalert2/sweetalert2.all.js')}}"></script>

<script src="{{ asset('common/js/iconify.min.js') }}"></script>
<script src="{{ asset('frontend/assets/vendor/intl-tel-input/js/intlTelInput.min.js') }}"></script>




@stack('script')

<script src="{{asset('admin/js/admin-custom.js')}}"></script>

<script src="{{asset('admin/js/metisMenu.min.js')}}"></script>

<script src="{{asset('admin/js/main.js')}}"></script>

<script src="{{asset('common/js/select2.min.js')}}"></script>

  

@if(isEnableOpenAI())

<script src="{{asset('addon/AI/js/main.js')}}"></script>

@endif





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

</body>

</html>

