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
                                <h2>{{__('Add Event')}}</h2>
                            </div>
                        </div>
                        <div class="breadcrumb__content__right">
                            <nav aria-label="breadcrumb">
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">{{__('Dashboard')}}</a></li>
                                    <li class="breadcrumb-item"><a href="{{route('event.index')}}">{{__('All Events')}}</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">{{__('Add Event')}}</li>
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
                            <h2>{{__('Add Event')}}</h2>
                        </div>
                        <form action="{{route('event.store')}}" method="post" class="form-horizontal" enctype="multipart/form-data">
                            @csrf

                            <div class="input__group mb-25">
                                <label>{{__('Title')}} <span class="text-danger">*</span></label>
                                <input type="text" name="title" value="{{old('title')}}" placeholder="{{__('Title')}}" class="form-control slugable"  onkeyup="slugable()">
                                @if ($errors->has('title'))
                                    <span class="text-danger"><i class="fas fa-exclamation-triangle"></i> {{ $errors->first('title') }}</span>
                                @endif
                            </div>

                            <div class="input__group mb-25">
                                <label>{{__('Slug')}} <span class="text-danger">*</span></label>
                                <input type="text" name="slug" value="{{old('slug')}}" placeholder="{{__('Slug')}}" class="form-control slug" onkeyup="getMyself()">
                                @if ($errors->has('slug'))
                                    <span class="text-danger"><i class="fas fa-exclamation-triangle"></i> {{ $errors->first('slug') }}</span>
                                @endif
                            </div>

                            <div class="input__group mb-25">
                                <label for="event_category"> {{ __('Event Category') }} </label>
                                <select name="event_category" id="event_category">
                                    <option value="">--{{ __('Select Option') }}--</option>
                                    @foreach($eventCategories as $eventCategory)
                                    <option value="{{ $eventCategory->id }}">{{ $eventCategory->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="input__group mb-25">
                                <label for="event_status"> {{ __('Event Status') }} </label>
                                <select name="event_status" id="event_status">
                                    <option value="">--{{ __('Select Option') }}--</option>
                                    <option value="1">Active Event</option>
                                    <option value="2">Past Event</option>
                                    <option value="3">Future Event</option>
                                </select>
                            </div>
                            <div class="input__group mb-25">
                                <label for="ticket_type"> {{ __('Ticker Type') }} </label>
                                <select name="ticket_type" id="ticket_type">
                                    <option value="">--{{ __('Select Option') }}--</option>
                                    <option value="1">Standard Ticket</option>
                                    <option value="2">Advanced Ticket</option>
                                    <option value="3">PRO Ticket</option>
                                    <option value="4">VIP Ticket</option>
                                </select>
                            </div>
                            <div class="row">
                                <div class="input__group mb-25 col-md-4">
                                    <label for="country_id"> {{ __('Country') }} </label>
                                    <select name="country_id" id="country_id" class="form-select">

                                        <option value="">{{__('Select Country')}}</option>

                                        @foreach($countries as $country)

                                            <option value="{{$country->id}}" @if(old('country_id'))

                                                {{old('country_id') == $country->id ? 'selected' : '' }}

                                                @endif >{{$country->country_name}}</option>

                                        @endforeach

                                    </select>
                                </div>
                                <div class="input__group mb-25 col-md-4">
                                    <label for="state_id"> {{ __('State') }} </label>
                                    <select name="state_id" id="state_id" class="form-select">

                                        <option value="">{{__('Select State')}}</option>

                                        @if(old('country_id'))

                                            @foreach($states as $state)

                                                <option value="{{$state->id}}" {{old('state_id') == $state->id ? 'selected' : ''}} >{{$state->name}}</option>

                                            @endforeach

                                        @endif

                                    </select>

                                </div>
                                <div class="input__group mb-25 col-md-4">
                                    <label for="city_id"> {{ __('City') }} </label>
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
                            
                            <div class="row">
                                <div class="input__group mb-25 col-md-6">
                                    <label>{{__('Event Start Date')}} <span class="text-danger">*</span></label>
                                    <input type="date" name="start_date" value="" class="form-control">
                                </div>
                                
                                <div class="input__group mb-25 col-md-6">
                                    <label>{{__('Event End Date')}} <span class="text-danger">*</span></label>
                                    <input type="date" name="end_date" value="" class="form-control">
                                </div>
                                
                                <div class="input__group mb-25 col-md-4">
                                    <label>{{__('Event Start Time')}} <span class="text-danger">*</span></label>
                                    <input type="text" name="start_time" value="{{old('slug')}}" placeholder="{{__('Event Start Time')}}" class="form-control" onkeyup="getMyself()">
                                </div>
                                
                                <div class="input__group mb-25 col-md-4">
                                    <label>{{__('Event End Time')}} <span class="text-danger">*</span></label>
                                    <input type="text" name="end_time" value="{{old('slug')}}" placeholder="{{__('Event End Time')}}" class="form-control" onkeyup="getMyself()">
                                </div>

                                <div class="input__group mb-25 col-md-4">
                                    <label>{{__('Total Event Duration in Minutes')}} <span class="text-danger">*</span></label>
                                    <input type="text" name="event_duration" value="{{old('slug')}}" placeholder="{{__('Total Event Duration in Minutes')}}" class="form-control" onkeyup="getMyself()">
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="input__group mb-25 col-md-6">
                                    <label>{{__('Minimum Number of Members')}} <span class="text-danger">*</span></label>
                                    <input type="text" name="min_members" value="{{old('slug')}}" placeholder="{{__('Minimum Number of Members')}}" class="form-control" onkeyup="getMyself()">
                                </div>

                                <div class="input__group mb-25 col-md-6">
                                    <label>{{__('Maximum Number of Members')}} <span class="text-danger">*</span></label>
                                    <input type="text" name="max_members" value="{{old('slug')}}" placeholder="{{__('Maximum Number of Members')}}" class="form-control" onkeyup="getMyself()">
                                </div>
                                
                                <div class="input__group mb-25 col-md-6">
                                    <label>{{__('Event Organizer')}} <span class="text-danger">*</span></label>
                                    <input type="text" name="event_organizer" value="{{old('slug')}}" placeholder="{{__('Event Organizer')}}" class="form-control" onkeyup="getMyself()">
                                </div>
                                
                                <div class="input__group mb-25 col-md-6">
                                    <label>{{__('Event Language')}} <span class="text-danger">*</span></label>
                                    <input type="text" name="event_language" value="{{old('slug')}}" placeholder="{{__('Event Language')}}" class="form-control" onkeyup="getMyself()">
                                </div>

                                <div class="input__group mb-25 col-md-6">
                                    <label>{{__('Number of Lead Teachers')}} <span class="text-danger">*</span></label>
                                    <input type="text" name="num_lead_teachers" value="{{old('slug')}}" placeholder="{{__('Number of Lead Teachers')}}" class="form-control" onkeyup="getMyself()">
                                </div>
                                
                                <div class="input__group mb-25 col-md-6">
                                    <label>{{__('Full Name of the Lead Teachers')}} <span class="text-danger">*</span></label>
                                    <input type="text" name="name_lead_teachers" value="{{old('slug')}}" placeholder="{{__('Full Name of the Lead Teachers')}}" class="form-control" onkeyup="getMyself()">
                                </div>
                                
                                <div class="input__group mb-25 col-md-6">
                                    <label>{{__('Event Sponsors')}} <span class="text-danger">*</span></label>
                                    <input type="text" name="event_sponsors" value="{{old('slug')}}" placeholder="{{__('Event Sponsors')}}" class="form-control" onkeyup="getMyself()">
                                </div>

                            </div>  
                            <div class="row">

                                <div class="input__group mb-25 col-md-3">
                                    <label for="buffet_reception"> {{ __('Buffet Reception') }}  <span class="text-danger">*</span></label>
                                    <select name="buffet_reception" id="buffet_reception">
                                        <option value="">--{{ __('Select Option') }}--</option>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </div>
                                
                                <div class="input__group mb-25 col-md-3">
                                    <label for="event_entertainment"> {{ __('Entertainment') }}  <span class="text-danger">*</span></label>
                                    <select name="event_entertainment" id="event_entertainment">
                                        <option value="">--{{ __('Select Option') }}--</option>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </div>
                                
                                <div class="input__group mb-25 col-md-3">
                                    <label for="event_prizes"> {{ __('Prizes') }}  <span class="text-danger">*</span></label>
                                    <select name="event_prizes" id="event_prizes">
                                        <option value="">--{{ __('Select Option') }}--</option>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </div>
                                
                                <div class="input__group mb-25 col-md-3">
                                    <label for="event_materials"> {{ __('Materials') }}  <span class="text-danger">*</span></label>
                                    <select name="event_materials" id="event_materials">
                                        <option value="">--{{ __('Select Option') }}--</option>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </div>
                                
                                <div class="input__group mb-25 col-md-3">
                                    <label for="event_books"> {{ __('Books') }}  <span class="text-danger">*</span></label>
                                    <select name="event_books" id="event_books">
                                        <option value="">--{{ __('Select Option') }}--</option>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </div>
                                
                                <div class="input__group mb-25 col-md-3">
                                    <label for="event_quizzes"> {{ __('Quizzes') }}  <span class="text-danger">*</span></label>
                                    <select name="event_quizzes" id="event_quizzes">
                                        <option value="">--{{ __('Select Option') }}--</option>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </div>
                                
                                <div class="input__group mb-25 col-md-3">
                                    <label for="event_testing"> {{ __('Testing') }}  <span class="text-danger">*</span></label>
                                    <select name="event_testing" id="event_testing">
                                        <option value="">--{{ __('Select Option') }}--</option>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </div>
                                
                                <div class="input__group mb-25 col-md-3">
                                    <label for="event_party"> {{ __('Party') }}  <span class="text-danger">*</span></label>
                                    <select name="event_party" id="event_party">
                                        <option value="">--{{ __('Select Option') }}--</option>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </div>
                                
                                <div class="input__group mb-25 col-md-3">
                                    <label for="event_transfer"> {{ __('Transfer') }}  <span class="text-danger">*</span></label>
                                    <select name="event_transfer" id="event_transfer">
                                        <option value="">--{{ __('Select Option') }}--</option>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </div>
                                
                                <div class="input__group mb-25 col-md-3">
                                    <label for="event_certificate"> {{ __('Certificate') }}  <span class="text-danger">*</span></label>
                                    <select name="event_certificate" id="event_certificate">
                                        <option value="">--{{ __('Select Option') }}--</option>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </div>

                            </div>
                            <div class="row">
                                <div class="input__group mb-25 col-md-6">
                                    <label>{{__('Standard Ticket Price')}} <span class="text-danger">*</span></label>
                                    <input type="text" name="standard_ticket_price" value="{{old('slug')}}" placeholder="{{__('Standard Ticket Price')}}" class="form-control" onkeyup="getMyself()">
                                </div>

                                <div class="input__group mb-25 col-md-6">
                                    <label>{{__('Standard Ticket Price with Discount')}} <span class="text-danger">*</span></label>
                                    <input type="text" name="standard_ticket_price_discount" value="{{old('slug')}}" placeholder="{{__('Standard Ticket Price with Discount')}}" class="form-control" onkeyup="getMyself()">
                                </div>
                                
                                <div class="input__group mb-25 col-md-6">
                                    <label>{{__('Advanced Ticket Price')}} <span class="text-danger">*</span></label>
                                    <input type="text" name="advanced_ticket_price" value="{{old('slug')}}" placeholder="{{__('Advanced Ticket Price')}}" class="form-control" onkeyup="getMyself()">
                                </div>
                                
                                <div class="input__group mb-25 col-md-6">
                                    <label>{{__('PRO Ticket Price')}} <span class="text-danger">*</span></label>
                                    <input type="text" name="pro_ticket_price" value="{{old('slug')}}" placeholder="{{__('PRO Ticket Price')}}" class="form-control" onkeyup="getMyself()">
                                </div>
                                
                                <div class="input__group mb-25 col-md-6">
                                    <label>{{__('VIP Ticket Price')}} <span class="text-danger">*</span></label>
                                    <input type="text" name="vip_ticket_price" value="{{old('slug')}}" placeholder="{{__('VIP Ticket Price')}}" class="form-control" onkeyup="getMyself()">
                                </div>
                                
                            </div>

                            <div class="row">
                                <div class="col-md-3">
                                    <label>{{__('Event Logo')}} <span class="text-danger">*</span></label>
                                    <div class="upload-img-box mb-25">
                                        <img src="">
                                        <input type="file" name="logo_image" id="image" accept="image/*" onchange="previewFile(this)">
                                        <div class="upload-img-box-icon">
                                            <i class="fa fa-camera"></i>
                                            <p class="m-0">{{__('Image')}}</p>
                                        </div>
                                    </div>
                                </div>
                                @if ($errors->has('logo_image'))
                                    <span class="text-danger"><i class="fas fa-exclamation-triangle"></i> {{ $errors->first('image') }}</span>
                                @endif
                                <p>{{ __('Accepted Files') }}: JPEG, JPG, PNG <br> {{ __('Recommend Size') }}: 870 x 500 (1MB)</p>
                            </div>

                            <div class="row">
                                <div class="col-md-3">
                                    <label>{{__('Main Photo')}} <span class="text-danger">*</span></label>
                                    <div class="upload-img-box mb-25">
                                        <img src="">
                                        <input type="file" name="main_image" id="image" accept="image/*" onchange="previewFile(this)">
                                        <div class="upload-img-box-icon">
                                            <i class="fa fa-camera"></i>
                                            <p class="m-0">{{__('Image')}}</p>
                                        </div>
                                    </div>
                                </div>
                                @if ($errors->has('main_image'))
                                    <span class="text-danger"><i class="fas fa-exclamation-triangle"></i> {{ $errors->first('image') }}</span>
                                @endif
                                <p>{{ __('Accepted Files') }}: JPEG, JPG, PNG <br> {{ __('Recommend Size') }}: 870 x 500 (1MB)</p>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-12 text-right">
                                    @saveWithAnotherButton
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

    <!-- Summernote CSS - CDN Link -->
    <link href="{{ asset('common/css/summernote/summernote.min.css') }}" rel="stylesheet">
    <link href="{{ asset('common/css/summernote/summernote-lite.min.css') }}" rel="stylesheet">
    <!-- //Summernote CSS - CDN Link -->
@endpush

@push('script')
    <script src="{{asset('admin/js/custom/image-preview.js')}}"></script>
    <script src="{{asset('admin/js/custom/slug.js')}}"></script>
    <script src="{{asset('admin/js/custom/form-editor.js')}}"></script>
    
    <script src="{{asset('admin/js/custom/admin-profile.js')}}"></script>

    <!-- Summernote JS - CDN Link -->
    <script src="{{ asset('common/js/summernote/summernote-lite.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $("#summernote").summernote({dialogsInBody: true});
            $('.dropdown-toggle').dropdown();
        });
    </script>
    <!-- //Summernote JS - CDN Link -->
@endpush
