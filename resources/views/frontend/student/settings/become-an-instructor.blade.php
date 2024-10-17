@extends('frontend.layouts.app')

@php

    $authUser = @auth()->user();

@endphp


@section('content')

    <div class="bg-page">

        <!-- Page Header Start -->

        <header class="page-banner-header gradient-bg position-relative">

            <div class="section-overlay">

                <div class="container">

                    <div class="row">

                        <div class="col-12 col-sm-12 col-md-12">

                            <div class="page-banner-content text-center">

                                <h3 class="page-banner-heading text-white pb-15">{{__('Become a Partner')}}</h3>



                                <!-- Breadcrumb Start-->

                                <nav aria-label="breadcrumb">

                                    <ol class="breadcrumb justify-content-center">

                                        <li class="breadcrumb-item font-14"><a href="{{ url('/') }}">{{__('Home')}}</a></li>

                                        <li class="breadcrumb-item font-14 active" aria-current="page">{{__('Become a Partner')}}</li>

                                    </ol>

                                </nav>

                                <!-- Breadcrumb End-->

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </header>

        <!-- Page Header End -->



        <!-- Course Instructor and Support Area Start -->

        <section class="become-instructor-feature-area section-t-space">

            <div class="container">

                <div class="row become-instructor-feature-wrap">



                    @foreach($instructorFeatures as $instructorFeature)

                        <!-- Become Instructor Feature Item start-->

                        <div class="col-md-4">

                            <div class="become-instructor-feature-item bg-white theme-border">

                                <div class="instructor-support-img-wrap">

                                    <img src="{{ getImageFile($instructorFeature->image_path) }}" alt="support">

                                </div>

                                <h6>{{ __($instructorFeature->title) }}</h6>

                                <p>{{ __($instructorFeature->subtitle) }}</p>

                            </div>

                        </div>

                        <!-- Become Instructor Feature Item End-->

                    @endforeach



                </div>

                <div class="row">

                    <div class="d-flex justify-content-sm-center become-instructor-call-to-action align-items-center mt-50">

                        <a href="{{route('student.show-instructor-info-form')}}" class="theme-btn theme-button1 theme-button3 mr-30"> {{__('Become a Partner')}} <i data-feather="arrow-right"></i></a>

                        <a href="{{route('contact')}}" class="text-decoration-underline font-15 font-medium"> {{__('Contact With Us')}}</a>

                    </div>

                </div>

            </div>

        </section>

        <!-- Course Instructor and Support Area End -->



        <!-- Become an instructor Procedures Area Start -->

        <section class="become-an-instructor-procedures-area">

            <div class="container">



                @foreach($instructorProcedures as $instructorProcedure)

                    <!-- Become an instructor procedure item start-->

                    <div class="row become-an-instructor-procedure-item align-items-center">

                        <div class="col-md-6">

                            <div class="become-an-instructor-procedure-item-left overflow-hidden">

                                <img src="{{ getImageFile($instructorProcedure->image_path) }}" alt="about" class="img-fluid">

                            </div>

                        </div>

                        <div class="col-md-6">

                            <div class="become-an-instructor-procedure-item-right">

                                <div class="section-title">

                                    <h3 class="section-heading">{{ __($instructorProcedure->title) }}</h3>

                                </div>

                                <p class="mb-15">{{ __($instructorProcedure->subtitle) }}</p>

                            </div>

                        </div>

                    </div>

                    <!-- Become an instructor procedure item end-->

                @endforeach



            </div>

        </section>

        <!-- Become an instructor Procedures Area End -->



        <!-- Counter Area Start -->

        <section class="counter-area bg-light section-t-space">

            <div class="container">

                <div class="row">



                    <!-- Counter Item start-->

                    <div class="col-md-6 col-lg-3">

                        <div class="counter-item d-flex align-items-center">

                            <div class="flex-shrink-0 counter-img-wrap">

                                <img src="{{asset('frontend/assets/img/icons-svg/counter-1.png')}}" alt="img">

                            </div>

                            <div class="flex-grow-1 ms-3 counter-content">

                                <h4 class="count-content"><span class="counter">{{ @$total_students }}</span>+</h4>

                                <p class="font-14 font-medium color-gray mt-2">{{ __('Students') }}</p>

                            </div>

                        </div>

                    </div>

                    <!-- Counter Item End-->



                    <!-- Counter Item start-->

                    <div class="col-md-6 col-lg-3">

                        <div class="counter-item d-flex align-items-center">

                            <div class="flex-shrink-0 counter-img-wrap">

                                <img src="{{asset('frontend/assets/img/icons-svg/counter-2.png')}}" alt="img">

                            </div>

                            <div class="flex-grow-1 ms-3 counter-content">

                                <h4 class="count-content"><span class="counter">{{ @$total_enrollments }}</span></h4>

                                <p class="font-14 font-medium color-gray mt-2">{{ __('Enrollments') }}</p>

                            </div>

                        </div>

                    </div>

                    <!-- Counter Item End-->



                    <!-- Counter Item start-->

                    <div class="col-md-6 col-lg-3">

                        <div class="counter-item d-flex align-items-center">

                            <div class="flex-shrink-0 counter-img-wrap">

                                <img src="{{asset('frontend/assets/img/icons-svg/counter-3.png')}}" alt="img">

                            </div>

                            <div class="flex-grow-1 ms-3 counter-content">

                                <h4 class="count-content"><span class="counter">{{ @$total_instructors }}</span>+</h4>

                                <p class="font-14 font-medium color-gray mt-2">{{ __('Instructor') }}</p>

                            </div>

                        </div>

                    </div>

                    <!-- Counter Item End-->



                    <!-- Counter Item start-->

                    <div class="col-md-6 col-lg-3">

                        <div class="counter-item d-flex align-items-center">

                            <div class="flex-shrink-0 counter-img-wrap">

                                <img src="{{asset('frontend/assets/img/icons-svg/counter-4.png')}}" alt="img">

                            </div>

                            <div class="flex-grow-1 ms-3 counter-content">

                                <h4 class="count-content"><span class="counter">100</span>%</h4>

                                <p class="font-14 font-medium color-gray mt-2">{{ __('Satisfaction') }}</p>

                            </div>

                        </div>

                    </div>

                    <!-- Counter Item End-->



                </div>

            </div>

        </section>

        <!-- Counter Area End -->



        <!-- Become instructor Call to action Area Start -->

        <section class="become-instructor-call-to-action section-t-space text-center">

            <div class="container">

                <div class="row">

                    <div class="col-12">

                        <h3 class="section-heading">{{ __(get_option('app_instructor_footer_title')) }}</h3>

                        <div class="col-lg-6 mx-auto">

                            <p class="font-20 mb-4">{{ __(get_option('app_instructor_footer_subtitle')) }}</p>

                            <div class="d-flex justify-content-center align-items-center">

                                <a href="{{route('student.show-instructor-info-form')}}" class="theme-btn theme-button1 theme-button3 mr-30"> {{__('Become a Partner')}} <i data-feather="arrow-right"></i></a>
                                <a href="{{route('contact')}}" target="_blank" class="text-decoration-underline font-15 font-medium">{{__('Contact With Us')}}</a>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </section>

    </div>


 {{--  Will be Remove when check Code --}}
    <!-- Become an Instructor Modal Start -->

    {{-- <div class="modal fade becomeAnInstructorModal" id="becomeAnInstructor" tabindex="-1" aria-labelledby="becomeAnInstructorLabel" aria-hidden="true">

        <div class="modal-dialog modal-dialog-centered">

            <div class="modal-content">

                <div class="modal-header">

                    <h6 class="modal-title" id="becomeAnInstructorLabel">{{ __('Submit your application') }}</h6>

                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                </div>



                <form method="POST" action="{{route('student.save-instructor-info')}}" class="needs-validation" novalidate enctype="multipart/form-data">

                    @csrf

                    <div class="modal-body">


                @if(@$authUser->role == USER_ROLE_STUDENT )
                    @if(@$authUser->instructor || @$authUser->organization)

                        <div class="row mb-30">

                            <div class="col-md-12">

                                <p>Your Application has Been Submitted Successfully! Please Wait, We are Checking Your Details as Soon as Possible. Thank You</p>

                            </div>

                        </div>
                    @else

                        <div class="row mb-30">

                            <div class="col-md-12">

                                <label class="label-text-title color-heading font-medium font-16 mb-2">{{__('First Name')}}</label>

                                <input type="text" name="first_name" class="form-control" id="first_name" placeholder="Write your first name" value="{{ @Auth::user()->student->first_name }}" required>

                            </div>

                            @if ($errors->has('first_name'))

                                <span class="text-danger"><i class="fas fa-exclamation-triangle"></i> {{ $errors->first('first_name') }}</span>

                            @endif

                        </div>

                        <div class="row mb-30">

                            <div class="col-md-12">

                                <label class="label-text-title color-heading font-medium font-16 mb-2">{{__('Last Name')}}</label>

                                <input type="text" name="last_name" class="form-control" id="last_name" placeholder="Write your last name" value="{{ @Auth::user()->student->last_name }}" required>

                            </div>

                            @if ($errors->has('last_name'))

                                <span class="text-danger"><i class="fas fa-exclamation-triangle"></i> {{ $errors->first('last_name') }}</span>

                            @endif

                        </div>



                        <div class="row mb-30">

                            <div class="col-md-12">

                                <label class="label-text-title color-heading font-medium font-16 mb-2">{{__('Account Type')}}</label>

                                <select class="form-control"  name="account_type" onchange="addOrgDetails(this.value)">

                                    <option value="{{ USER_ROLE_INSTRUCTOR }}">{{ __('Teacher') }}</option>

                                    <option value="{{ USER_ROLE_ORGANIZATION }}">{{ __('Organization') }}</option>

                                </select>

                            </div>

                            @if ($errors->has('account_type'))

                                <span class="text-danger"><i class="fas fa-exclamation-triangle"></i> {{ $errors->first('account_type') }}</span>

                            @endif

                        </div>



                        <div class="row org-details">

                            <div class="col-md-12" id="full_org_name_area">

                                <label class="label-text-title color-heading font-medium font-16 mb-2">{{__('Full Organization Name')}}</label>

                                <input type="text" name="full_organization_name" class="form-control" id="full_org_name" placeholder="Full Organization Name" value="" required>

                            </div>
                        </div>

                        <div class="row org-details">
                            <div class="col-md-12" id="official_id_area">

                                <label class="label-text-title color-heading font-medium font-16 mb-2">{{__('Official Identification Number')}}</label>

                                <input type="text" name="official_id_number" class="form-control" id="official_id" placeholder="Official Identification Number" value="" required>

                            </div>
                        </div>

                        <div class="row org-details">
                            <div class="col-md-12" id="number_of_teachers_area">

                                <label class="label-text-title color-heading font-medium font-16 mb-2">{{__('Number of Teachers in Your Organization')}}</label>

                                <input type="text" name="number_of_teachers" class="form-control" id="number_of_teachers" placeholder="Number of Teachers in Y our Organization" value="" required>

                            </div>
                        </div>



                        <div class="row mb-30">

                            <div class="col-md-12">

                                <label for="professional_title" class="label-text-title color-heading font-medium font-16 mb-2">{{__('Professional Title')}}</label>

                                <input type="text" name="professional_title" class="form-control" id="professional_title" placeholder="{{__('Professional Title')}}" value="{{ old('professional_title') }}">

                            </div>

                            @if ($errors->has('professional_title'))

                                <span class="text-danger"><i class="fas fa-exclamation-triangle"></i> {{ $errors->first('professional_title') }}</span>

                            @endif

                        </div>



                        <div class="row mb-30" >

                            <div class="col-md-12">   <label>{{ __('Phone Number') }} <span class="text-danger">*</span></label>  </div>
                                <input type="hidden" id="register_hidden_phone_code" name="area_code">
                            <div class="col-md-2">
                                <input type="text" name="phone_code" id="register_phone_code" value="{{old('mobile_number')}}" class="form-control"  placeholder="Type your mobile number">
                            </div>

                            <div class="col-md-10 mb-25">
                                <input type="text" name="phone_number" id="phone_number" value="{{ @Auth::user()->student->phone_number }}" class="form-control"  placeholder="Type your phone number">
                                @if ($errors->has('phone_number'))
                                <span class="text-danger"><i class="fas fa-exclamation-triangle"></i> {{
                                    $errors->first('phone_number') }}</span>
                                @endif

                            </div>


                        </div>



                        <div class="row mb-30">

                            <div class="col-md-12">

                                <label class="label-text-title color-heading font-medium font-16 mb-2">{{__('Address')}}</label>

                                <input type="text" name="address" class="form-control" id="address" placeholder="{{__('Address')}}" value="{{ old('address') ?? @Auth::user()->student->address }}" required>

                            </div>

                            @if ($errors->has('address'))

                                <span class="text-danger"><i class="fas fa-exclamation-triangle"></i> {{ $errors->first('address') }}</span>

                            @endif

                        </div>



                        <div class="row mb-30">

                            <div class="col-md-12">

                                <label class="label-text-title color-heading font-medium font-16 mb-2">CV</label>

                                <div class="create-assignment-upload-files">

                                    <input type="file" name="cv_file" accept="application/pdf"  class="form-control" />

                                    <p class="font-14 color-heading text-center mt-2 color-gray">No file selected (PDF) <span class="d-block">Maximum Image Upload Size is <span class="color-heading">5mb</span></span> </p>

                                </div>

                                @if ($errors->has('cv_file'))

                                    <span class="text-danger"><i class="fas fa-exclamation-triangle"></i> {{ $errors->first('cv_file') }}</span>

                                @endif

                            </div>

                        </div>



                        <div class="row mb-30">

                            <div class="col-md-12">

                                <label class="label-text-title color-heading font-medium font-16 mb-2">{{__('Bio')}}</label>

                                <textarea name="about_me" class="form-control" cols="30" rows="10" placeholder="About your self" required>{{ old('about_me') }}</textarea>

                            </div>

                            @if ($errors->has('about_me'))

                                <span class="text-danger"><i class="fas fa-exclamation-triangle"></i> {{ $errors->first('about_me') }}</span>

                            @endif

                        </div>
                    @endif
                @endif



                    </div>

            @if(@$authUser->role == USER_ROLE_STUDENT )
                @if(@$authUser->instructor || @$authUser->organization)
                @else
                    <div class="modal-footer d-flex justify-content-center align-items-center">

                        <button type="submit" class="theme-btn theme-button1 default-hover-btn">{{__('Submit')}}</button>
                    </div>
                @endif
            @endif

                </form>

            </div>

        </div>

    </div> --}}

    <!-- Become an Instructor Modal End -->



@endsection



@push('script')

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
            utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.12/js/utils.js"
        });


        var phone = "+{{ Auth::user()->area_code.@Auth::user()->student->phone_number }}";
        iti.setNumber(phone);

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

    @if (@$errors->any())

        <script>

            var myModal = document.getElementById('becomeAnInstructor');

            var modal = bootstrap.Modal.getOrCreateInstance(myModal)

            modal.show()

        </script>

    @endif
    <script>
        $("#full_org_name_area").hide();
        $("#official_id_area").hide();
        $("#number_of_teachers_area").hide();
        function addOrgDetails(v){
            $("#full_org_name").val("");
            $("#official_id").val("");
            $("#number_of_teachers").val("");
            if(v == 4){
                $(".org-details").addClass("mb-30");
                $("#full_org_name_area").show();
                $("#official_id_area").show();
                $("#number_of_teachers_area").show();
            } else {
                $(".org-details").removeClass("mb-30");
                $("#full_org_name_area").hide();
                $("#official_id_area").hide();
                $("#number_of_teachers_area").hide();
            }
        }
    </script>
@endpush

