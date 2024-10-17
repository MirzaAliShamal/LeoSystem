@extends('layouts.admin')



@section('content')

    <!-- Page content area start -->

    <div class="page-content">

        <div class="container-fluid">

            <div class="row">

                <div class="col-md-12">

                    <div class="breadcrumb__content">

                        <div class="breadcrumb__content__left">

                            <div class="breadcrumb__title">

                                <h2>{{__('Profile')}}</h2>

                            </div>

                        </div>

                        <div class="breadcrumb__content__right">

                            <nav aria-label="breadcrumb">

                                <ul class="breadcrumb">

                                    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">{{__('Dashboard')}}</a></li>

                                    <li class="breadcrumb-item active" aria-current="page">{{__('Update Profile')}}</li>

                                </ul>

                            </nav>

                        </div>

                    </div>

                </div>

            </div>

            <div class="row">

                <div class="col-md-12">

                    <div class="customers__area bg-style mb-30">

                        <div class="item-title d-flex justify-content-between">

                            <h2>{{__('Update Profile')}}</h2>

                        </div>

                        <form action="{{route('admin.profile.update')}}" method="post" class="form-horizontal" enctype="multipart/form-data">

                            @csrf



                            <div class="row">

                                <div class="col-md-9">



                                    <div class="row">

                                        <div class="col-md-6">

                                            <div class="input__group mb-25">

                                                <label for="name">{{__('Name')}} <span class="text-danger">*</span></label>

                                                <input type="text" name="name" id="name" value="{{auth::user()->name}}" placeholder="{{__('Name')}}" class="form-control">

                                                @if ($errors->has('name'))

                                                    <span class="text-danger"><i class="fas fa-exclamation-triangle"></i> {{ $errors->first('name') }}</span>

                                                @endif

                                            </div>

                                        </div>

                                        <div class="col-md-6">
                                            <div class="row mb-30"> 
                            
                                                <div class="col-md-12"> <label class="label-text-title color-heading font-medium font-16 mb-3" for="mobile_number">{{__('Phone Number')}}<span class="text-danger">*</span></label>  </div>
                                                <input type="hidden" id="register_hidden_phone_code" name="area_code">
                                                <div class="col-md-3"> 
                                                    <input type="text" name="phone_code" id="register_phone_code" class="form-control"  placeholder="Type your phone number">  
                                                </div>
                    
                                                <div class="col-md-9">  
                                                    <input type="text" name="phone_number" id="phone_number" value="{{auth::user()->phone_number}}"  class="form-control"  placeholder="Type your phone number"> 
                                                    @if ($errors->has('phone_number')) 
                                                    <span class="text-danger"><i class="fas fa-exclamation-triangle"></i> {{ 
                                                        $errors->first('phone_number') }}</span> 
                                                    @endif
                    
                                                </div>
                    
                                            </div>

                                            {{-- <div class="input__group mb-25">

                                                <label for="phone_number">{{__('Phone Number')}} <span class="text-danger">*</span></label>

                                                <input type="text" name="phone_number" id="phone_number" value="{{auth::user()->phone_number}}" placeholder="{{__('Phone Number')}}" class="form-control">

                                                @if ($errors->has('phone_number'))

                                                    <span class="text-danger"><i class="fas fa-exclamation-triangle"></i> {{ $errors->first('phone_number') }}</span>

                                                @endif

                                            </div> --}}

                                        </div>

                                    </div>

                                    <div class="row">

                                        <div class="col-md-6">

                                            <div class="input__group mb-25">

                                                <label for="address">{{__('Email')}} <span class="text-danger">*</span></label>

                                                <input type="text" name="email" id="email" value="{{auth::user()->email}}" placeholder="{{ __('Email') }}" class="form-control">

                                                @if ($errors->has('email'))

                                                    <span class="text-danger"><i class="fas fa-exclamation-triangle"></i> {{ $errors->first('email') }}</span>

                                                @endif

                                            </div>

                                        </div>

                                        <div class="col-md-6">

                                            <div class="input__group mb-25">

                                                <label for="address">{{__('Address')}} <span class="text-danger">*</span></label>

                                                <textarea name="address" id="address" class="form-control" placeholder="{{__('Address')}}">{{auth::user()->address}}</textarea>

                                                @if ($errors->has('address'))

                                                    <span class="text-danger"><i class="fas fa-exclamation-triangle"></i> {{ $errors->first('address') }}</span>

                                                @endif

                                            </div>

                                        </div>

                                    </div>

                                </div>



                                <div class="col-md-3">

                                    <div class="upload-img-box mb-25 overflow-hidden">

                                        @if(auth()->user()->image)

                                            <img src="{{getImageFile(auth()->user()->image)}}" alt="img" class="img-fluid">

                                        @else

                                            <img src="" alt="img">

                                        @endif

                                        <input type="file" name="image" id="image" accept="image/*" onchange="previewFile(this)">

                                        <div class="upload-img-box-icon">

                                            <i class="fa fa-camera"></i>

                                            <p class="m-0">{{__('Image')}}</p>

                                        </div>

                                    </div>

                                    <p>{{ __('Accepted Image Files') }}: JPEG, JPG, PNG <br> {{ __('Accepted Size') }}: 300 x 300 (1MB)</p>

                                </div>

                            </div>



                            <div class="row mb-3">

                                <div class="col-md-12">

                                    @updateButton

                                </div>

                            </div>



                        </form>

                    </div>

                </div>

            </div>



        </div>

    </div>

    <!-- Page content area end -->

@endsection



@push('style')

    <link rel="stylesheet" href="{{asset('admin/css/custom/image-preview.css')}}">

@endpush



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
    <script src="{{asset('admin/js/custom/image-preview.js')}}"></script>

@endpush

