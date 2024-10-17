@extends('frontend.layouts.app')

@php

    $authUser = @auth()->user();

@endphp

@push('style')
    <link rel="stylesheet" href="{{ asset('common/css/select2.css') }}">
@endpush


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



    <section class="become-instructor-feature-area section-t-space">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="col-md-10">
                    <form method="POST" action="{{route('student.save-instructor-info')}}" class="needs-validation" novalidate enctype="multipart/form-data">

                        @csrf

                        <div class="modal-body">


                    @if (@$authUser->role == USER_ROLE_STUDENT)
                                    @if (@$authUser->instructor || @$authUser->organization)
                                        <div class="row mb-30">

                                            <div class="col-md-12">

                                                <p>Your Application has Been Submitted Successfully! Please Wait, We are
                                                    Checking Your Details as Soon as Possible. Thank You</p>

                                            </div>

                                        </div>
                                    @else
                                        <div class="row mb-30">
                                            <div class="col-md-12 mb-5">
                                                <h2 style="font-size: 22px; line-height: 28px;color:#000000">
                                                    Application Form
                                                    To Become a
                                                    Partner</h2>
                                            </div>

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
                                        <option>Select Account Type</option>
                                        <option value="{{ USER_ROLE_INSTRUCTOR }}">{{ __('Teacher') }}</option>

                                        <option value="{{ USER_ROLE_ORGANIZATION }}">{{ __('Organization') }}</option>

                                    </select>

                                </div>

                                @if ($errors->has('account_type'))

                                    <span class="text-danger"><i class="fas fa-exclamation-triangle"></i> {{ $errors->first('account_type') }}</span>

                                @endif

                            </div>



                            <div class="row org-details mb-3">

                                <div class="col-md-12" id="first_last_middle_en_area">

                                    <label class="label-text-title color-heading font-medium font-16 mb-2">{{__('First Last and Middle name Only in English')}}</label>
                                    <div class="row">
                                        <div class="col-md-4 col-sm-12">
                                            <input type="text" name="first_name_en" class="form-control" id="first_name_en" placeholder="First Name English" value="" required>
                                        </div>
                                        <div class="col-md-4 col-sm-12">
                                            <input type="text" name="last_name_en" class="form-control" id="last_name_en" placeholder="Last Name English" value="" required>
                                        </div>
                                        <div class="col-md-4 col-sm-12">
                                            <input type="text" name="middle_name_en" class="form-control" id="middle_name_en" placeholder="Middle Name English" value="" required>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row org-details">

                                <div class="col-md-12" id="full_org_name_area">

                                    <label class="label-text-title color-heading font-medium font-16 mb-2">{{__('Full Organization Name')}}</label>

                                    <input type="text" name="full_organization_name" class="form-control" id="full_org_name" placeholder="Full Organization Name" value="" required>

                                </div>
                            </div>

                            <div class="row org-details">

                                <div class="col-md-12" id="full_org_name_en_area">

                                    <label class="label-text-title color-heading font-medium font-16 mb-2">{{__('Full Organization Name Only in English')}}</label>

                                    <input type="text" name="full_organization_name_en" class="form-control" id="full_org_name_en" placeholder="Full Organization Name Only in English" value="" required>

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
                                    <select class="form-select" name="native_speaker[]" id="native_speaker" multiple>
                                        @php
                                            $languages = \DB::table('native_speaker_languages')->get()
                                        @endphp
                                        @foreach($languages as $key => $lang)
                                            <option value="{{ $lang->code }}">{{ $lang->name }}</option>
                                        @endforeach
                                    </select>
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

                            <button type="submit" id="submitButton" class="theme-btn theme-button1 default-hover-btn">{{__('Submit')}}</button>
                        </div>
                    @endif
                @endif

                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
            {{-- <div class="modal-header">

                <h6 class="modal-title" id="becomeAnInstructorLabel">{{ __('Submit your application') }}</h6>

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

            </div> --}}






@endsection
@push('script')
<script src="{{ asset('common/js/select2.min.js') }}"></script>

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

     $('#native_speaker').select2({
         placeholder: 'Native Speaker',
         allowClear: true,
     });
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
        $("#full_org_name_en_area").hide();
        $("#official_id_area").hide();
        $("#number_of_teachers_area").hide();
        function addOrgDetails(v){
            $("#full_org_name").val("");
            $("#full_org_name_en").val("");
            $("#official_id").val("");
            $("#number_of_teachers").val("");
            var submitButton = $("#submitButton");
            if (v == '{{ USER_ROLE_ORGANIZATION }}') {
                submitButton.text("{{ __('Apply Now to Become an Organization') }}");
            }
            else if (v == '{{ USER_ROLE_INSTRUCTOR }}') {
                submitButton.text("{{ __('Apply Now to Become a Teacher') }}");
            }else{
                submitButton.text("{{ __('Submit') }}");
            }
            if(v == 4){
                $(".org-details").addClass("mb-30");
                $("#full_org_name_area").show();
                $("#full_org_name_en_area").show();
                $("#official_id_area").show();
                $("#number_of_teachers_area").show();
                $("#first_last_middle_en_area").hide();
            } else {
                $(".org-details").removeClass("mb-30");
                $("#full_org_name_area").hide();
                $("#full_org_name_en_area").hide();
                $("#official_id_area").hide();
                $("#number_of_teachers_area").hide();
                $("#first_last_middle_en_area").show();
            }
        }
    </script>
@endpush
