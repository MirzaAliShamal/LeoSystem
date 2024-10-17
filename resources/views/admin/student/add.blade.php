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

                                <h2>{{ __('Add Student') }}</h2>

                            </div>

                        </div>

                        <div class="breadcrumb__content__right">

                            <nav aria-label="breadcrumb">

                                <ul class="breadcrumb">

                                    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">{{__('Dashboard')}}</a></li>

                                    <li class="breadcrumb-item active" aria-current="page">{{ __('Add Student') }}</li>

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

                            <h2>{{ __('Add Student') }}</h2>

                        </div>

                        <form action="{{route('student.store')}}" method="post" class="form-horizontal" enctype="multipart/form-data">

                            @csrf

                            <div class="row">

                                <div class="col-md-6">

                                    <div class="input__group mb-25">

                                        <label>{{__('First Name')}} <span class="text-danger">*</span></label>

                                        <input type="text" name="first_name" value="{{old('first_name')}}" placeholder="{{ __('First Name') }}" class="form-control" required>

                                        @if ($errors->has('first_name'))

                                            <span class="text-danger"><i class="fas fa-exclamation-triangle"></i> {{ $errors->first('first_name') }}</span>

                                        @endif

                                    </div>

                                </div>

                                <div class="col-md-6">

                                    <div class="input__group mb-25">

                                        <label>{{__('Last Name')}} <span class="text-danger">*</span></label>

                                        <input type="text" name="last_name" value="{{old('last_name')}}" placeholder="{{ __('Last Name') }}" class="form-control" required>

                                        @if ($errors->has('last_name'))

                                            <span class="text-danger"><i class="fas fa-exclamation-triangle"></i> {{ $errors->first('last_name') }}</span>

                                        @endif

                                    </div>

                                </div>

                                <div class="col-md-6">

                                    <div class="input__group mb-25">

                                        <label>{{__('Email')}} <span class="text-danger">*</span></label>

                                        <input type="email" name="email" value="{{old('email')}}" placeholder="{{ __('Email') }}" class="form-control" required>

                                        @if ($errors->has('email'))

                                            <span class="text-danger"><i class="fas fa-exclamation-triangle"></i> {{ $errors->first('email') }}</span>

                                        @endif

                                    </div>

                                </div>

                                <div class="col-md-6">

                                    <div class="input__group mb-25">

                                        <label>{{ __('Password') }} <span class="text-danger">*</span></label>

                                        <input type="password" name="password" value="{{old('password')}}" placeholder="{{ __('Password') }}" class="form-control" required>

                                        @if ($errors->has('password'))

                                            <span class="text-danger"><i class="fas fa-exclamation-triangle"></i> {{ $errors->first('password') }}</span>

                                        @endif

                                    </div>

                                </div>
                               
                            
                            <div class="col-md-12">   <label>{{ __('Phone Number') }} <span class="text-danger">*</span></label>  </div>
                            <input type="hidden" id="register_hidden_phone_code" name="area_code">
                            <div class="col-md-1"> 
                                <input type="text" name="phone_code" id="register_phone_code" value="{{old('mobile_number')}}" class="form-control"  placeholder="Type your mobile number">  
                            </div>

                            <div class="col-md-11 mb-25">  
                                <input type="text" name="phone_number" id="phone_number" value="{{old('phone_number')}}" class="form-control"  placeholder="Type your phone number"> 
                                @if ($errors->has('phone_number')) 
                                <span class="text-danger"><i class="fas fa-exclamation-triangle"></i> {{ 
                                    $errors->first('phone_number') }}</span> 
                                @endif

                            </div> 

                                <div class="col-md-6">

                                    <div class="input__group mb-25">

                                        <label>{{ __('Address') }} <span class="text-danger">*</span></label>

                                        <input type="text" name="address" value="{{old('address')}}" placeholder="{{ __('Address') }}" class="form-control"

                                               required>

                                        @if ($errors->has('address'))

                                            <span class="text-danger"><i class="fas fa-exclamation-triangle"></i> {{ $errors->first('address') }}</span>

                                        @endif

                                    </div>

                                </div>

                                <div class="col-md-6">

                                    <div class="input__group mb-25">

                                        <label>{{ __('Postal Code') }} <span class="text-danger">*</span></label>

                                        <input type="text" name="postal_code" value="{{old('postal_code')}}" placeholder="{{ __('Postal Code') }}" class="form-control"

                                               required>

                                        @if ($errors->has('postal_code'))

                                            <span class="text-danger"><i class="fas fa-exclamation-triangle"></i> {{ $errors->first('postal_code') }}</span>

                                        @endif

                                    </div>

                                </div>

                                <div class="col-md-6">

                                    <div class="input__group mb-25">

                                        <label>{{__('Country')}}</label>

                                        <select name="country_id" id="country_id" class="form-select">

                                            <option value="">{{__('Select Country')}}</option>

                                            @foreach($countries as $country)

                                                <option value="{{$country->id}}" @if(old('country_id'))

                                                    {{old('country_id') == $country->id ? 'selected' : '' }}

                                                    @endif >{{$country->country_name}}</option>

                                            @endforeach

                                        </select>

                                    </div>

                                </div>

                                <div class="col-md-6">

                                    <div class="input__group mb-25">

                                        <label>{{__('State')}}</label>

                                        <select name="state_id" id="state_id" class="form-select">

                                            <option value="">{{__('Select State')}}</option>

                                            @if(old('country_id'))

                                                @foreach($states as $state)

                                                    <option value="{{$state->id}}" {{old('state_id') == $state->id ? 'selected' : ''}} >{{$state->name}}</option>

                                                @endforeach

                                            @endif

                                        </select>

                                    </div>

                                </div>

                                <div class="col-md-6">

                                    <div class="input__group mb-25">

                                        <label>{{__('City')}}</label>

                                        <select name="city_id" id="city_id" class="form-select">

                                            <option value="">{{__('Select City')}}</option>

                                            @if(old('state_id'))

                                                @foreach($cities as $city)

                                                    <option value="{{$city->id}}" {{old('city_id') == $city->id ? 'selected' : '' }} >{{$city->name}}</option>

                                                @endforeach

                                            @endif

                                        </select>

                                    </div>

                                </div>

                                <div class="col-md-6">

                                    <div class="input__group mb-25">

                                        <label>{{__('Gender')}}<span class="text-danger">*</span></label>

                                        <select name="gender" id="gender" class="form-select" required>

                                            <option value="">{{__('Select Option')}}</option>

                                            <option value="Male" {{old('gender') == 'Male' ? 'selected' : '' }} >{{ __('Male') }}</option>

                                            <option value="Female" {{old('gender') == 'Female' ? 'selected' : '' }} >{{ __('Female') }}</option>

                                            <option value="Others" {{old('gender') == 'Others' ? 'selected' : '' }} >{{ __('Others') }}</option>

                                        </select>

                                    </div>

                                </div>

                                <div class="col-md-12">

                                    <div class="input__group mb-25">

                                        <label>{{ __('About Student') }} <span class="text-danger">*</span></label>

                                        <textarea name="about_me" id="" cols="15" rows="5" required>{{ old('about_me') }}</textarea>

                                        @if ($errors->has('about_me'))

                                            <span class="text-danger"><i class="fas fa-exclamation-triangle"></i> {{ $errors->first('about_me') }}</span>

                                        @endif

                                    </div>

                                </div>

                            </div>



                            <div class="row">

                                <div class="col-md-3">

                                    <div class="upload-img-box mb-25">

                    <!--                  <input type="file" name="image" class="image">-->
                    <!--<input type="hidden" name="image_base64">-->
                    <!--<img src="" style="width: 200px;display: none;" class="show-image">-->
                                         <img src="">

                                        <input type="file" name="image" id="image" accept="image/*" onchange="previewFile(this)">

                                        <div class="upload-img-box-icon">

                                            <i class="fa fa-camera"></i>

                                            <p class="m-0">{{__('Image')}}</p>

                                        </div>

                                    </div>

                                </div>

                                @if ($errors->has('image'))

                                    <span class="text-danger"><i class="fas fa-exclamation-triangle"></i> {{ $errors->first('image') }}</span>

                                @endif

                                <p>{{ __('Accepted Image Files') }}: JPEG, JPG, PNG <br> {{ __('Accepted Size') }}: 300 x 300 (1MB)</p>

                            </div>



                            <div class="row mb-3">

                                <div class="col-md-12 text-right">

                                    <button class="btn btn-primary" type="submit">{{ __('Save') }}</button>

                                </div>

                            </div>



                        </form>

                    </div>

                </div>

            </div>



        </div>

    </div>

    <!-- Page content area end -->
    
     <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLabel">Image must be  600 by 600</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="img-container">
                        <div class="row">
                            <div class="col-md-8">
                                <img id="image" src="https://avatars0.githubusercontent.com/u/3456749">
                            </div>
                            <div class="col-md-4">
                                <div class="preview"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="crop">Crop</button>
                </div>
            </div>
        </div>
    </div>

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

    <script src="{{asset('admin/js/custom/admin-profile.js')}}"></script>
   

@endpush

