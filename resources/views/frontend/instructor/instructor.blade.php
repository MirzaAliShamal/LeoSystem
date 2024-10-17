@extends('frontend.layouts.app')
@push('style')
<link rel="stylesheet" href="{{ asset('common/css/select2.css') }}">

<style>
    /* For WebKit browsers (Chrome, Safari, Edge) */
    ::-webkit-scrollbar {
        width: 12px; /* Change this value to adjust the width */
    }

    ::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 10px; /* Rounded track */
    }

    ::-webkit-scrollbar-thumb {
        background: #888;
        border-radius: 10px; /* Rounded scrollbar */
    }

    ::-webkit-scrollbar-thumb:hover {
        background: #555;
    }

    /* For Firefox */
    * {
        scrollbar-width: thin; /* Options: auto, thin, none */
        scrollbar-color: #888 #f1f1f1; /* thumb color, track color */
    }

    /* For IE and Edge (prior to Chromium) */
    body {
        -ms-overflow-style: -ms-autohiding-scrollbar; /* auto-hiding scrollbars */
    }

    /* General styles for cross-browser consistency */
    .scrollbar {
        scrollbar-width: thin;
        scrollbar-color: #888 #f1f1f1;
    }
    .filters{
        display: flex;
        gap: 10px;
        overflow-x: auto;
        overflow-y: hidden;
    }
    .filters, .filters span, .filters input, .filters button{
        font-size: 15px !important;
        font-weight: 500;
        color: #6b6a6a;
    }

    ::placeholder {
        color: #6b6a6a;
        opacity: 1; /* Firefox */
    }

    ::-ms-input-placeholder { /* Edge 12 -18 */
        color: #6b6a6a;
    }

    .filters-dropdown{
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);

    }

    .filters .filter-dropdown , select {
        width: 400px !important;
        /*height: 40px;*/
    }
    .filter-dropdown .dropdown-toggle {
        position: relative;
    }
    .filter-dropdown .dropdown-toggle::after {
        content: '';
        border: solid #000;
        border-width: 0 1px 1px 0;
        display: inline-block;
        padding: 3px;
        transform: rotate(45deg);
        position: absolute;
        right: 1rem; /* Adjust as necessary */
        top: 45%;
        transform: translateY(-50%) rotate(45deg);
        pointer-events: none;
    }

    .filter-dropdown .dropdown-menu {
        max-height: 400px;
        overflow-y: auto;
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
        border: none;
        border-radius: 33px;
    }

    /* Hide scrollbar in WebKit browsers */
    .dropdown-menu::-webkit-scrollbar {
        width: 0; /* Remove scrollbar space */
        background: transparent; /* Optional: just make scrollbar invisible */
    }
    /* Hide scrollbar in Firefox */
    .dropdown-menu {
        scrollbar-width: none; /* For Firefox */
    }

    .filter-dropdown .dropdown-item:hover{
        background: none;
    }

    .form-check-label {
        cursor: pointer;
    }

    .form-check-input:checked + .form-check-label {
        font-weight: bold;
    }

    .leaflet-popup-content {
        padding: 0 !important;
        width: 260px !important;
    }
    .shop-content{
        max-height: 800px;
        overflow-y: auto;
    }

    .categories{
        border-bottom-right-radius: 33px;
        border-top-right-radius: 33px;
    }
    .filter-container {
        padding: 20px;
        max-width: 900px;
        margin: auto;
    }
    .filter-buttons button, .time-buttons button {
        margin: 5px;
        border-radius: 20px;
        font-size: 14px;
    }
    .selected {
        background-color: var(--color-yellow);
        color: white;
    }
    .calendar {
        display: flex;
        flex-wrap: wrap;
        font-size: smaller;
    }
    .calendar .day {
        text-align: center;
        flex: 1 0 12%;
    }
    .calendar .day .hour {
        /*padding: 5px;*/
        cursor: pointer;
    }
    .calendar .day .hour.selected {
        background-color: var(--color-yellow);
        color: white;
        border-radius: 50%;
    }

    .morning-hours, .afternoon-hours{
        font-size: small;
    }
    .caption{
        font-size: 10px;
        text-align: center;
    }
    .caption:before, .caption:after{
        content: '';
        flex: 1;
        border-bottom: 1px solid #000;
    }

    .caption:not(:empty)::before {
        margin-right: .25em;
    }

    .caption:not(:empty)::after {
        margin-left: .25em;
    }
    .date{
        font-weight: bold;
        font-size: 1rem;
        color: grey;
    }

    .hover-container{
        position: relative;
    }

    .hover-button{
        position: relative;
        z-index: 1;
    }

    .hover-content {
        display: none;
        position: absolute;
        top: -10px; /* Starting position, a bit below the button */
        left: 50%;
        width: 100%;
        transform: translateX(-50%);
        background-color: #f9f9f9;
        border: 1px solid #ccc;
        border-radius: 18px;
        padding: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        z-index: 2;
        opacity: 0;
        transition: top 0.3s ease, opacity 0.3s ease;
        white-space: nowrap; /* Prevents line breaks for long content */
    }

    .hover-container:hover .hover-content {
        display: block;
        top: -50px; /* End position, a bit above the button */
        opacity: 1;
    }

    .popover {
        max-width: 100%; /* Maximum width for the popover */
        width: auto; /* Adjust width automatically */
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
        border-radius: 33px;
    }

    .free-trail-lesson  ,.total-showing{
        font-size: 13px;
    }

    @media (max-width: 1300px) {
        .category-type, #meeting_types, .lesson-price-btn, .native-speaker, .rating-type{
            width: 200px !important;
        }
        .lesson-time-popover {
            width: 1000px !important;
        }
        .free-trail-lesson  ,.total-showing{
            font-size: 12px;
        }
    }

    @media (max-width: 768px) {
        .calendar .day {
            /*flex: 1 0 25%;*/
        }

    }
    @media (max-width: 576px) {
        .calendar .day {
            flex: 1 0 50%;
        }
    }


    .filters ::-webkit-scrollbar-track {
        -webkit-box-shadow: inset 0 0 5px  #adaaaa;
        border-radius: 8px;
        background-color: #F5F5F5;
    }
    .filters ::-webkit-scrollbar {
        width: 10px;
    }
    .filters ::-webkit-scrollbar-thumb {
        border-radius: 10px;
        -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,.3);
        background-color: #afb0b3;
    }

    .pac-container {
        font-family: 'Montserrat', sans-serif;
        font-size: 15px;
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        border-radius: 18px;
        padding: 0 20px;
        width: 100%;
        z-index: 1050;
    }

    .pac-container .pac-logo {
        display: none !important;
        height: 0px !important;
        padding: 0px !important;
        margin: 0px !important;
        overflow: hidden !important;
    }


    #cross-icon {
        position: absolute;
        right: 10px;
        top: 50%;
        transform: translateY(-50%);
        display: none;
        cursor: pointer;
    }

    .hidden {
        width: 0;
        padding: 0;
        overflow: hidden;
    }

    #map {
        height: 100%;
        width: 100%;
    }

    #map-container {
        /*width: 100%; !* Initial width of the map *!*/
        transition: width 0.3s ease;
        position: relative;
    }

    #toggle-button {
        position: absolute;
        top: 10px;
        left: 25px;
        z-index: 11;
        background-color: #fff;
        border: 1px solid #ccc;
        padding: 10px 15px;
        border-radius: 8px;
        cursor: pointer;
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
    }
    .leaflet-control-zoom{
        display: none;
    }

    .user-item:hover {
        background-color: #f0f0f0;
    }

    .blinking-marker {
        animation: blinking 1s infinite;
    }

    @keyframes blinking {
        0% { opacity: 1; }
        50% { opacity: 0; }
        100% { opacity: 1; }
    }
</style>
@endpush
@section('content')
<div class="bg-page">
    <!-- Page Header Start -->
    <header class="page-banner-header blank-page-banner-header gradient-bg position-relative">
        <div class="section-overlay">
            <div class="blank-page-banner-wrap banner-less-header-wrap p-0">
            </div>
        </div>
    </header>
    <!-- Page Header End -->

    <!-- Instructor Search Map Area Start -->
{{--    <section class="insturctor-search-map-area">--}}
{{--        <div class="container-fluid">--}}
{{--            <div class="row">--}}
{{--                <div class="col-12 p-0">--}}
{{--                    <div id="map" class="w-100"></div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </section>--}}
    <!-- Instructor Search Map Area End -->

    <section class="courses-page-area instructor-search-page-area">
        <div class="container-fluid">
            <!-- instructor Filters start-->
            <!-- instructor Filters start-->
            <div class=" filters my-2 mx-1">
                <!-- Location-address -->
{{--                <div class="p-0">--}}
                <div class="input-group search-container" style="width: 700px;">
                    <span class="input-group-text bg-transparent default-border border-secondary search-icon" style="border-right: none;border-top-right-radius: 0px !important;border-bottom-right-radius: 0px !important;border-right: none !important;height: 40px;" id="basic-addon1">
                        <img src="{{ asset('frontend/assets/img/icons-svg/search.svg') }}" alt="Search">
                    </span>
                    <input style="height: 40px;border-top-left-radius: 0px !important;border-bottom-left-radius: 0px !important;border-left: none !important;" class="form-control me-2 p-2 border default-border border-1 border-secondary bg-transparent location-address" id="location-address" placeholder="Enter Location Address">
                </div>

                {{--                </div>--}}

                <!-- categories -->
{{--                <div class=" p-0">--}}
                    <div class="filter-dropdown w-100">
                        <button class="btn btn-outline default-border border-1 border-secondary p-2 border dropdown-toggle d-flex gap-1 w-100 category-type" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span>Category Type</span> <span class="text-secondary text-md-center font-bold" id="categories-count">0</span>
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <div class="px-3 py-2">
                                <input type="text" class="form-control" placeholder="Type to search...">
                            </div>
                            <div class="dropdown-divider"></div>
                            <div class="px-3">
                                @foreach ($categories as $category)
                                    <div class="form-check" onchange="filterData()">
                                        <input class="form-check-input categories" name="category_ids" type="checkbox" value="{{ $category->id }}" id="category{{$category->id}}">
                                        <label class="form-check-label" for="category{{$category->id}}">{{ $category->name }}</label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
{{--                </div>--}}

                <!-- meeting-types -->
                <div class="filter-dropdown">
                    <button class="btn btn-default default-border border-1 border-secondary p-2 border dropdown-toggle lesson-price-btn w-100" id="lesson-price-btn" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Meeting Types
                    </button>
                    <div class="dropdown-menu p-5" aria-labelledby="lesson-price-btn" onchange="filterData()">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="available_type" id="available_type" value="3">
                            <label class="form-check-label" for="available_type">
                                {{ __('All Types') }}
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="available_type" id="online" value="2">
                            <label class="form-check-label" for="online">
                                {{ __('Online') }}
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="available_type" id="offline" value="1">
                            <label class="form-check-label" for="offline">
                                {{ __('Offline') }}
                            </label>
                        </div>

                    </div>
                </div>

                <!-- lesson-price -->
{{--                <div class=" p-0">--}}
                    <div class="filter-dropdown">
                        <button class="btn btn-default default-border border-1 border-secondary p-2 border dropdown-toggle lesson-price-btn w-100" id="lesson-price-btn" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Class Price
                        </button>
                        <div class="dropdown-menu p-5" aria-labelledby="lesson-price-btn">
                            <div id="slider-range-instructor" class="price-filter-range mt-0"></div>
                            <div class=" w-100 border p-3 rounded"><label for="price-min">Minimum:</label><input disabled type="number" min=0 value=0 id="price-min" name="price_min" class="price-range-field" /></div>
                            <div class=" w-100 border p-3 rounded"><label for="price-max">Maximum:</label><input disabled type="number" max="{{ $priceMax }}" value="{{ $priceMax }}" name="price_max" id="price-max" class="price-range-field" /></div>
                        </div>
                    </div>
{{--                </div>--}}

                <!-- native_speaker -->
{{--                <div class=" p-0">--}}
                    <div class="filter-dropdown">
                        <button class="btn btn-outline default-border border-1 border-secondary p-2 border dropdown-toggle d-flex gap-1 w-100 native-speaker" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span>Native Speaker</span> <span class="text-secondary text-md-center font-bold" id="native_speaker-count">0</span>
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <div class="px-3 py-2">
                                <input type="text" class="form-control" placeholder="Type to search...">
                            </div>
                            <div class="dropdown-divider"></div>
                            <div class="px-3">
                                @php
                                    $native_languages = \DB::table('native_speaker_languages')->get();
                                @endphp
                                @foreach ($native_languages as $lang)
                                    <div class="form-check">
                                        <input class="form-check-input native_speaker" onchange="filterData()" name="native_speaker" type="checkbox" value="{{ $lang->code }}" id="native-speaker{{$lang->code}}">
                                        <label class="form-check-label" for="native-speaker{{$lang->code}}">{{ $lang->name }}</label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
{{--                </div>--}}

                <!-- lesson-time -->
{{--                <div class=" p-0">--}}

                <button class="default-border p-2 border border-1 border-secondary lesson-time-popover" style="height: 40px;width: 400px;" data-toggle="popover" data-placement="bottom">
                    Class Time
                </button>
                <div id="lessonTimeContent" style="display: none;">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="d-flex justify-content-between mb-3 mx-5">
                                <a class="btn" id="prev-week">
                                    <span class="fas fa-chevron-circle-left"></span>
                                </a>
                                <div id="week-range" class="align-self-center"></div>
                                <a class="btn" id="next-week" onclick="next()">
                                    <span class="fas fa-chevron-circle-right"></span>
                                </a>
                            </div>
                            <div class="calendar">
                                <!-- Calendar will be dynamically generated here -->
                            </div>
                            <div class="mt-3 text-center">
                                <span class="default-border caption">Morning Hours</span>
                                <div class="row hour-group morning-hours mb-3">
                                    <div class="hour col-sm-2 default-border" data-hour="00:00">00:00</div>
                                    <div class="hour col-sm-2 default-border" data-hour="01:00">01:00</div>
                                    <div class="hour col-sm-2 default-border" data-hour="02:00">02:00</div>
                                    <div class="hour col-sm-2 default-border" data-hour="03:00">03:00</div>
                                    <div class="hour col-sm-2 default-border" data-hour="04:00">04:00</div>
                                    <div class="hour col-sm-2 default-border" data-hour="05:00">05:00</div>
                                    <div class="hour col-sm-2 default-border" data-hour="06:00">06:00</div>
                                    <div class="hour col-sm-2 default-border" data-hour="07:00">07:00</div>
                                    <div class="hour col-sm-2 default-border" data-hour="08:00">08:00</div>
                                    <div class="hour col-sm-2 default-border" data-hour="09:00">09:00</div>
                                    <div class="hour col-sm-2 default-border" data-hour="10:00">10:00</div>
                                    <div class="hour col-sm-2 default-border" data-hour="11:00">11:00</div>
                                </div>
                                <span class="default-border caption">Afternoon Hours</span>
                                <div class="row hour-group afternoon-hours">
                                    <div class="hour col-sm-2 default-border" data-hour="12:00">12:00</div>
                                    <div class="hour col-sm-2 default-border" data-hour="13:00">13:00</div>
                                    <div class="hour col-sm-2 default-border" data-hour="14:00">14:00</div>
                                    <div class="hour col-sm-2 default-border" data-hour="15:00">15:00</div>
                                    <div class="hour col-sm-2 default-border" data-hour="16:00">16:00</div>
                                    <div class="hour col-sm-2 default-border" data-hour="17:00">17:00</div>
                                    <div class="hour col-sm-2 default-border" data-hour="18:00">18:00</div>
                                    <div class="hour col-sm-2 default-border" data-hour="19:00">19:00</div>
                                    <div class="hour col-sm-2 default-border" data-hour="20:00">20:00</div>
                                    <div class="hour col-sm-2 default-border" data-hour="21:00">21:00</div>
                                    <div class="hour col-sm-2 default-border" data-hour="22:00">22:00</div>
                                    <div class="hour col-sm-2 default-border" data-hour="23:00">23:00</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
{{--                </div>--}}

                <!-- rating -->
{{--                <div class=" p-0">--}}
                    <div class="filter-dropdown">
                        <button class="btn btn-outline default-border border-1 border-secondary p-2 border dropdown-toggle d-flex gap-1 w-100 rating-type" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span>Rating Type</span> <span class="text-secondary text-md-center font-bold" id="rating-count">0</span>
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <div class="px-3">
                                <div class="sidebar-radio-item">
                                    <div class="form-check">
                                        <input class="form-check-input rating" onchange="filterData()" name="rating[]" type="checkbox" value="4.5" id="rating-5">
                                        <label class="form-check-label" for="rating-5">
                                            <span class="iconify text-warning" data-icon="bi:star-fill"></span>
                                            <span class="iconify text-warning" data-icon="bi:star-fill"></span>
                                            <span class="iconify text-warning" data-icon="bi:star-fill"></span>
                                            <span class="iconify text-warning" data-icon="bi:star-fill"></span>
                                            <span class="iconify text-warning" data-icon="bi:star-half"></span>
                                            {{ __('4.5 & up') }}
                                        </label>
                                    </div>
                                </div>
                                <div class="sidebar-radio-item">
                                    <div class="form-check">
                                        <input class="form-check-input rating" onchange="filterData()" name="rating[]" type="checkbox" value="4" id="rating-4">
                                        <label class="form-check-label" for="rating-4">
                                            <span class="iconify" data-icon="bi:star-fill"></span>
                                            <span class="iconify" data-icon="bi:star-fill"></span>
                                            <span class="iconify" data-icon="bi:star-fill"></span>
                                            <span class="iconify" data-icon="bi:star-fill"></span>
                                            <span class="iconify" data-icon="bi:star"></span>
                                            {{ __('4.0 & up') }}
                                        </label>
                                    </div>
                                </div>
                                <div class="sidebar-radio-item">
                                    <div class="form-check">
                                        <input class="form-check-input rating" onchange="filterData()" name="rating[]" type="checkbox" value="3.5" id="rating-3">
                                        <label class="form-check-label" for="rating-3">
                                            <span class="iconify" data-icon="bi:star-fill"></span>
                                            <span class="iconify" data-icon="bi:star-fill"></span>
                                            <span class="iconify" data-icon="bi:star-fill"></span>
                                            <span class="iconify" data-icon="bi:star-half"></span>
                                            <span class="iconify" data-icon="bi:star"></span>
                                            {{ __('3.5 & up') }}
                                        </label>
                                    </div>
                                </div>
                                <div class="sidebar-radio-item">
                                    <div class="form-check">
                                        <input class="form-check-input rating" onchange="filterData()" name="rating[]" type="checkbox" value="3" id="rating-3-0">
                                        <label class="form-check-label" for="rating-3-0">
                                            <span class="iconify" data-icon="bi:star-fill"></span>
                                            <span class="iconify" data-icon="bi:star-fill"></span>
                                            <span class="iconify" data-icon="bi:star-fill"></span>
                                            <span class="iconify" data-icon="bi:star"></span>
                                            <span class="iconify" data-icon="bi:star"></span>
                                            {{ __('3.0 & up') }}
                                        </label>
                                    </div>
                                </div>
                                <div class="sidebar-radio-item">
                                    <div class="form-check">
                                        <input class="form-check-input rating" onchange="filterData()" name="rating[]" type="checkbox" value="2.5" id="rating-2">
                                        <label class="form-check-label" for="rating-2">
                                            <span class="iconify" data-icon="bi:star-fill"></span>
                                            <span class="iconify" data-icon="bi:star-fill"></span>
                                            <span class="iconify" data-icon="bi:star-half"></span>
                                            <span class="iconify" data-icon="bi:star"></span>
                                            <span class="iconify" data-icon="bi:star"></span>
                                            {{ __('2.5 & up') }}
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
{{--                </div>--}}


            <!-- select-date -->
{{--                <div class="col-md-1 p-0">--}}
{{--                    <div class="filter-dropdown">--}}
{{--                        <button class="btn btn-outline default-border p-2 border dropdown-toggle d-flex gap-1 w-100" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">--}}
{{--                            <span>Select Dates</span> <span class="text-secondary text-md-center font-bold" id="consultation_day-count">0</span>--}}
{{--                        </button>--}}
{{--                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">--}}
{{--                            <div class="px-3 py-2">--}}
{{--                                <input type="text" class="form-control" placeholder="Type to search...">--}}
{{--                            </div>--}}
{{--                            <div class="dropdown-divider"></div>--}}
{{--                            <div class="px-3">--}}
{{--                                <div class="form-check">--}}
{{--                                    <input class="form-check-input consultation_day" onchange="filterData()" name="consultation_day[]" type="checkbox" value="0" id="sunday">--}}
{{--                                    <label class="form-check-label" for="sunday">{{ __('Sunday') }}</label>--}}
{{--                                </div>--}}
{{--                                <div class="form-check">--}}
{{--                                    <input class="form-check-input consultation_day" onchange="filterData()" name="consultation_day[]" type="checkbox" value="1" id="monday">--}}
{{--                                    <label class="form-check-label" for="monday">{{ __('Monday') }}</label>--}}
{{--                                </div>--}}
{{--                                <div class="form-check">--}}
{{--                                    <input class="form-check-input consultation_day" onchange="filterData()" name="consultation_day[]" type="checkbox" value="2" id="tuesday">--}}
{{--                                    <label class="form-check-label" for="tuesday">{{ __('Tuesday') }}</label>--}}
{{--                                </div>--}}
{{--                                <div class="form-check">--}}
{{--                                    <input class="form-check-input consultation_day" onchange="filterData()" name="consultation_day[]" type="checkbox" value="3" id="wednesday">--}}
{{--                                    <label class="form-check-label" for="wednesday">{{ __('Wednesday') }}</label>--}}
{{--                                </div>--}}
{{--                                <div class="form-check">--}}
{{--                                    <input class="form-check-input consultation_day" onchange="filterData()" name="consultation_day[]" type="checkbox" value="4" id="thursday">--}}
{{--                                    <label class="form-check-label" for="thursday">{{ __('Thursday') }}</label>--}}
{{--                                </div>--}}
{{--                                <div class="form-check">--}}
{{--                                    <input class="form-check-input consultation_day" onchange="filterData()" name="consultation_day[]" type="checkbox" value="5" id="friday">--}}
{{--                                    <label class="form-check-label" for="friday">{{ __('Friday') }}</label>--}}
{{--                                </div>--}}
{{--                                <div class="form-check">--}}
{{--                                    <input class="form-check-input consultation_day" onchange="filterData()" name="consultation_day[]" type="checkbox" value="6" id="saturday">--}}
{{--                                    <label class="form-check-label" for="saturday">{{ __('Saturday') }}</label>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
            </div>
            <!-- instructor Filters End-->

            <div class="row">
                <!-- Instructor Search Map Area Start -->
                <div class="col-md-7"  id="user-list">

                    <!-- instructor semi-filter start-->
                    <div class="row">
                        <div class="col-12">
                            <!-- Instructors Filter Bar Start-->
                            <div class="courses-filter-bar instructors-filter-bar">
                                <div class="row align-items-center mx-1">
                                    <div class="col-6 col-lg-2 mb-2 mb-lg-0 p-0">
                                        <p class="mb-0 total-showing">{{ __('Total Showing: 12') }}</p>
                                    </div>
                                    <div class="col-6 col-lg-3 mb-2 mb-lg-0 p-0">
                                        <div class="form-check form-switch d-flex justify-content-lg-start justify-content-center">
                                            <input class="form-check-input" type="checkbox" role="switch" id="free-trail-lesson">
                                            <label class="form-check-label mb-0 ms-2 free-trail-lesson" for="free-trail-lesson">Free Trail Lesson</label>
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-3 mb-2 mb-lg-0">
                                        <input class="form-control form-control-sm default-border bg-transparent border border-1 border-secondary w-100" name="search" onkeyup="filterData()" style="height: 38px;" type="text" placeholder="Search by Name / ID">
                                    </div>
                                    <div class="col-12 col-lg-4">
                                        <div class="filter-box d-flex align-items-center justify-content-lg-end justify-content-center border border-1 border-secondary">
                                            <div class="filter-box-short-icon color-gray font-15 w-100">
                                                <p class="mb-0">{{ __('Sort') }}:</p>
                                            </div>
                                            <select class="form-select form-select-sm filterSortBy ms-2" name="sort_by" onchange="filterData()">
                                                <option value="" selected>{{ __('Default') }}</option>
                                                <option value="asc">{{ __('Newest') }}</option>
                                                <option value="desc">{{ __('Oldest') }}</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Instructors Filter Bar End-->
                        </div>
                    </div>
                    <!-- instructor semi-filter end-->


                    <div class="row shop-content">
                        <!-- Show all Instructor area start-->
                        <div class="col-md-12 col-lg-12 col-xl-12 show-all-course-area-wrap" id="instructorParentBlock">
                            @include('frontend.instructor.render_instructor')
                            <!-- all courses grid End-->
                        </div>
                    </div>
                </div>
                <!-- Show all Instructor area End-->

                <!-- Instructor Search Map Area Start -->
                <div class="col-md-5" id="map-container">
                    <div id="map" class="w-100 h-100"></div>
                    <div id="toggle-button">
                        <span class="fas fa-chevron-left"></span>
                    </div>

                </div>
                <!-- Instructor Search Map Area End -->
            </div>
        </div>
    </div>

<!-- Lesson-Price-modal -->
<div class="modal fade" id="lessonPriceModal" tabindex="-1" role="dialog" aria-labelledby="lessonPriceTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="lessonPriceTitle">Lesson Price</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="slider-range-instructor" class="price-filter-range mt-0"></div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="range-value-wrap w-100"><label for="price-min">$Min:</label><input disabled type="number" min=0 value=0 id="price-min" name="price_min" class="price-range-field" /></div>
                    </div>
                    <div class="col-md-6">
                        <div class="range-value-wrap w-100"><label for="price-max">$Max:</label><input disabled type="number" max="{{ $priceMax }}" value="{{ $priceMax }}" name="price_max" id="price-max" class="price-range-field" /></div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary default-border px-3 py-2" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
</section>

</div>

@endsection
@push('style')
<link href='https://api.mapbox.com/mapbox.js/v3.3.1/mapbox.css' rel='stylesheet' />
    <link href='https://api.mapbox.com/mapbox.js/plugins/leaflet-markercluster/v1.0.0/MarkerCluster.css' rel='stylesheet' />
    <link href='https://api.mapbox.com/mapbox.js/plugins/leaflet-markercluster/v1.0.0/MarkerCluster.Default.css' rel='stylesheet' />
@endpush
@push('script')
    <script src="https://maps.googleapis.com/maps/api/js?key={{ config('googlemaps.key') }}&libraries=places"></script>
    <script src='https://api.mapbox.com/mapbox.js/v3.3.1/mapbox.js'></script>
<script src='https://api.mapbox.com/mapbox.js/plugins/leaflet-markercluster/v1.0.0/leaflet.markercluster.js'></script>
<script src="{{ asset('common/js/select2.min.js') }}"></script>
<script>

    const users = @json($users->items());
    function initMap() {
        const myLatLng = { lat: 22.2734719, lng: 70.7512559 };
        const map = new google.maps.Map(document.getElementById("map"), {
            zoom: 5,
            fullscreenControl:false,
            mapTypeControl: false, // Disables Map/Satellite view control
            streetViewControl: false, // Disables Street View control
            center: myLatLng,
            scaleControl:false,
            zoomControl: true, // Disables Zoom control
            zoomControlOptions: {
                position: google.maps.ControlPosition.TOP_RIGHT // Positions Zoom control at the top-left
            }
        });

        let openInfoWindow = null;

        users.forEach(user => {
            // Create the SVG for the custom marker
            const svgMarker = {
                path: `
                        M 0,0
                        A 25,25 0 1,1 0,-50
                        A 25,25 0 1,1 0,0
                        Z
                        M -25,-65
                        h 50
                        v 20
                        h -50
                        z`,
                fillColor: '#FF0000',
                fillOpacity: 2,
                strokeWeight: 2,
                scale: 2,
                anchor: new google.maps.Point(0, 0),
                labelOrigin: new google.maps.Point(0, -30)
            };

            // Create the marker with the custom SVG icon
            const marker = new google.maps.Marker({
                position: {lat:user.lat,lng:user.long},
                map,
                title: user.name,
                icon: {
                    url: `data:image/svg+xml;charset=UTF-8,${encodeURIComponent(`
                            <svg xmlns="http://www.w3.org/2000/svg" width="50" height="70">
                                <!-- Define the shadow filter -->
                                <defs>
                                    <filter id="shadow" x="-20%" y="-20%" width="140%" height="140%">
                                        <feGaussianBlur in="SourceAlpha" stdDeviation="3"/> <!-- Blur the image -->
                                        <feOffset dx="2" dy="2" result="offsetblur"/> <!-- Offset the shadow -->
                                        <feFlood flood-color="rgba(0,0,0,0.5)"/> <!-- Shadow color -->
                                        <feComposite in2="offsetblur" operator="in"/>
                                        <feMerge>
                                            <feMergeNode/>
                                            <feMergeNode in="SourceGraphic"/>
                                        </feMerge>
                                    </filter>
                                </defs>
                                <circle cx="25" cy="25" r="25" fill="white" stroke="black" stroke-width="1"/>
                                <clipPath id="clipCircle">
                                    <circle cx="25" cy="25" r="25"/>
                                </clipPath>
                                <image href="/${user.image}" x="0" y="0" width="50" height="50" clip-path="url(#clipCircle)"/>
                                <!-- Rounded background rectangle with shadow filter applied -->
                                <rect x="5" y="45" width="40" height="20" fill="white" rx="10" ry="10" filter="url(#shadow)"/>
                                <!-- Text element for the price -->
                                <text x="50%" y="60" font-size="16" fill="black" text-anchor="middle" font-weight="bold">${user.role == 4 ? user.organization.hourly_rate : user.instructor.hourly_rate}</text>
                            </svg>


                        `)}`,
                    scaledSize: new google.maps.Size(50, 70)
                }
            });

            // Create an InfoWindow for each marker
            const infoWindow = new google.maps.InfoWindow({
                content: `<div style="text-align: center;">
                                <img src="${user.image}" alt="${user.name}" style="width:50px;height:50px;border-radius:50%;">
                                <h4>${user.name}</h4>
                                <p>${user.email}</p>
                              </div>`
            });

            // Add a click listener to open the InfoWindow on marker click
            marker.addListener('click', () => {
                if (openInfoWindow) {
                    openInfoWindow.close();
                }
                infoWindow.open(map, marker);
                openInfoWindow = infoWindow;
            });

            // Close the InfoWindow when clicking outside the marker or on another marker
            map.addListener('click', () => {
                if (openInfoWindow) {
                    openInfoWindow.close();
                    openInfoWindow = null;
                }
            });

            document.querySelectorAll('.user-item').forEach(item => {
                item.addEventListener('mouseover', function() {
                    if (marker) {
                        map.setCenter(marker.getPosition());
                        map.setZoom(8); // Optionally, adjust the zoom level when focusing
                    }
                });
            });

        });

        // Add an event listener to load more users when the map is moved
        map.addListener('drag', (e) => {
            bounds = map.getBounds()
            filterData();
        });
    }

    initMap();

    const toggleButton = document.getElementById('toggle-button');
    const userList = document.getElementById('user-list');
    const mapContainer = document.getElementById('map-container');

    toggleButton.addEventListener('click', () => {
        if (userList.classList.contains('hidden')) {
            userList.classList.remove('hidden');
            mapContainer.style.width = null;
            // toggleButton.textContent = 'Expand Map';
            toggleButton.innerHTML = '<i class="fas fa-chevron-left"></i>';

        } else {
            userList.classList.add('hidden');
            mapContainer.style.width = '100%';
            // toggleButton.textContent = 'Show Users';
            toggleButton.innerHTML = '<i class="fas fa-chevron-circle-right"></i> Show Users';

        }
    });

    function initAutocomplete() {
        var input = document.getElementById('location-address');
        var autocomplete = new google.maps.places.Autocomplete(input);

        autocomplete.addListener('place_changed', function() {
            startSearch();
        });

        input.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                startSearch();
            }
        });

        // Adjust the autocomplete dropdown to match the input group width
        google.maps.event.addDomListener(window, 'resize', function() {
            var autocompleteContainer = document.querySelector('.pac-container');
            if (autocompleteContainer) {
                autocompleteContainer.style.width = input.parentElement.offsetWidth + "px";
            }
        });

        // Also trigger the resize logic when the dropdown first appears
        input.addEventListener('focus', function() {
            var autocompleteContainer = document.querySelector('.pac-container');
            if (autocompleteContainer) {
                autocompleteContainer.style.width = input.parentElement.offsetWidth + "px";
            }
        });
    }
    google.maps.event.addDomListener(window, 'load', initAutocomplete);

    function startSearch() {
        var address = document.getElementById('location-address').value;
        if (address) {
            console.log("Searching for:", address);
            // Implement your search logic here
        }
    }


    const paginateRoute = "{{ route('instructor_more') }}";
    const filterRoute = "{{ route('filter.instructor') }}";
    const maxPrice = "{{ $priceMax }}";
    const mapData =  @json($mapData);
    L.mapbox.accessToken = "{{ get_option('map_api_key') }}";

    $('#categories').select2({
        placeholder: 'Lesson Category',
        allowClear: true,
    });

    $('#native_speaker').select2({
        placeholder: 'Native Speaker',
        allowClear: true,
    });

    $('#rating').select2({
        placeholder: 'Rating',
        allowClear: true,
    });

    $('#select-date').select2({
        placeholder: 'Select Date',
        allowClear: true,
    });



    $(document).ready(function() {

        $('.lesson-time-popover').popover({
            trigger: 'click',
            html: true,
            content: function() {
                return $('#lessonTimeContent').html();
            }
        });

        $('.lesson-price-popover').popover({
            trigger: 'click',
            html: true,
            content: function() {
                return $('#lessonPriceContent').html();
            }
        });

        // Close popover on click outside
        $(document).on('click', function (e) {
            $('[data-toggle="popover"]').each(function () {
                if (!$(this).is(e.target) && $(this).has(e.target).length === 0 && $('.popover').has(e.target).length === 0) {
                    $(this).popover('hide');
                }
            });
        });

        const daysOfWeek = ['Fri', 'Sat', 'Sun', 'Mon', 'Tue', 'Wed', 'Thu'];
        let currentWeekStart = new Date();

        function updateCalendar() {
            const calendar = $('.calendar');
            calendar.empty();
            const weekDates = getWeekDates(currentWeekStart);
            weekDates.forEach((date, index) => {
                const dayDiv = $('<div>').addClass('day default-border py-2 px-0 gap-1');
                const dayDate = $('<div>').addClass('date').text(date.getDate());
                dayDiv.append($('<div>').text(daysOfWeek[index]));
                dayDiv.append(dayDate);
                calendar.append(dayDiv);
            });
            updateWeekRange(weekDates);
        }

        function updateWeekRange(weekDates) {
            const options = { month: 'short', day: 'numeric', year: 'numeric' };
            const start = weekDates[0].toLocaleDateString('en-US', options);
            const end = weekDates[6].toLocaleDateString('en-US', options);
            $('#week-range').text(`${start} - ${end}`);
        }

        function getWeekDates(startDate) {
            const dates = [];
            const start = new Date(startDate);
            for (let i = 0; i < 7; i++) {
                dates.push(new Date(start));
                start.setDate(start.getDate() + 1);
            }
            return dates;
        }

        // Delegated event handlers for dynamically generated content inside the popover
        $('body').on('click', '.popover #prev-week', function() {
            currentWeekStart.setDate(currentWeekStart.getDate() - 7);
            updateCalendar();
        });

        $('body').on('click', '#next-week', function() {
            currentWeekStart.setDate(currentWeekStart.getDate() + 7);
            updateCalendar();
        });

        $('body').on('click', '.popover .filter-buttons button, .popover .time-buttons button', function() {
            $('.calendar .day, .hour-group .hour').removeClass('selected');
            $(this).toggleClass('selected');
        });

        $('body').on('click', '.popover .calendar .day, .popover .hour-group .hour', function() {
            $('.filter-buttons button, .time-buttons button').removeClass('selected');
            $(this).toggleClass('selected');
        });

        updateCalendar();

        function filterLessons() {
            const selectedDays = $('.filter-buttons .selected').map(function() {
                return $(this).data('day');
            }).get();

            const selectedTimes = $('.time-buttons .selected').map(function() {
                return $(this).data('time');
            }).get();

            console.log('Selected Days:', selectedDays);
            console.log('Selected Times:', selectedTimes);

            // Add logic to filter and display lessons based on selectedDays and selectedTimes
        }
    });

    $(document).ready(function() {
        var categoriesCount = 0;
        var native_speakerCount = 0;
        var raingCount = 0;
        var consultation_dayCount = 0;

        // Calculate the initial count of checked checkboxes
        $('.categories:checked').each(function() {
            categoriesCount++;
        });
        // Update the badge with the initial count
        $('#categories-count').text(categoriesCount);
        $('.categories').on('change', function() {
            if ($(this).is(':checked')) {
                categoriesCount++;
            } else {
                categoriesCount--;
            }
            $('#categories-count').text(categoriesCount);
        });

        // Calculate the initial count of checked checkboxes
        $('.native_speaker:checked').each(function() {
            native_speakerCount++;
        });
        // Update the badge with the initial count
        $('#native_speaker-count').text(native_speakerCount);
        $('.native_speaker').on('change', function() {
            if ($(this).is(':checked')) {
                native_speakerCount++;
            } else {
                native_speakerCount--;
            }
            $('#native_speaker-count').text(native_speakerCount);
        });

        custom_multiselect('rating',raingCount)
        custom_multiselect('consultation_day',consultation_dayCount)

        function custom_multiselect(clsId,countId){
            // Calculate the initial count of checked checkboxes
            $(`.${clsId}:checked`).each(function() {
                countId++;
            });
            // Update the badge with the initial count
            $(`#${clsId}-count`).text(countId);
            $(`.${clsId}`).on('change', function() {
                if ($(this).is(':checked')) {
                    countId++;
                } else {
                    countId--;
                }
                $(`#${clsId}-count`).text(countId);
            });
        }

        $('.dropdown-menu input[type="text"]').on('keyup', function() {
            var value = $(this).val().toLowerCase();
            $(".form-check-label").filter(function() {
                $(this).closest('.form-check').toggle($(this).text().toLowerCase().indexOf(value) > -1);
            });
        });
    });

    function makeHover(hoverId,contentId){
        const Id = document.getElementById(hoverId)
        const content = document.getElementById(contentId);
        Id.addEventListener('mouseover', function() {
            content.style.display = 'block';
            setTimeout(() => {
                content.style.top = '30px';
                content.style.opacity = '1';
            }, 10);
        });
        Id.addEventListener('mouseout', function() {
            content.style.top = '-10px';
            content.style.opacity = '0';
            setTimeout(() => {
                content.style.display = 'block';
            }, 300); // Match this to the transition duration
        });
        content.addEventListener('mouseover', function() {
            content.style.top = '30px';
            content.style.opacity = '1';
        });
        content.addEventListener('mouseout', function() {
            content.style.top = '-10px';
            content.style.opacity = '0';
            setTimeout(() => {
                content.style.display = 'block';
            }, 300); // Match this to the transition duration
        });
    }


</script>
<script src="{{ asset('frontend/assets/js/custom/instructor-filter.js') }}"></script>
@endpush
