@extends('layouts.instructor')

@section('breadcrumb')
    <div class="page-banner-content text-center">
        <h3 class="page-banner-heading text-white pb-15"> {{__('Upload Course')}} </h3>

        <!-- Breadcrumb Start-->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb justify-content-center">
                <li class="breadcrumb-item font-14"><a href="{{route('instructor.dashboard')}}">{{__('Dashboard')}}</a>
                </li>
                <li class="breadcrumb-item font-14"><a href="{{ route('instructor.course') }}">{{__('My Courses')}}</a>
                </li>
                <li class="breadcrumb-item font-14 active" aria-current="page">{{__('Upload Course')}}</li>
            </ol>
        </nav>
    </div>
@endsection
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.css"/>
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.js"></script>

<style type="text/css">
    body {
        background: #f7fbf8;
    }

    h1 {
        font-weight: bold;
        font-size: 23px;
    }

    img {
        display: block;
        max-width: 100%
    }

    .preview {
        text-align: center;
        overflow: hidden;
        width: 130px;
        height: 160px;
        margin: 10px;
        border: 1px solid red;
        /* border-radius: 50%; Make the preview circular */
    }

    .img-container {
        /* Never limit the container height here */
        max-width: 100%;
    }

    .img-container img {
        /* This is important */
        width: 100%;
        height: 100%;
        object-fit: cover !important;
    }

    input {
        margin-top: 40px;
    }

    .section {
        margin-top: 150px;
        background: #fff;
        padding: 50px 30px;
    }

    .modal-lg {
        max-width: 1000px !important;
    }

    /*.cropper-modal{*/
    /*    background: transparent !important;*/
    /*}*/

    /*.cropper-wrap-box {*/
    /*    !*background-color: white !important;*!*/
    /*    overflow: hidden !important;*/
    /*}*/

    .modal-content{
        width: auto !important;
    }

    /*.modal-body{*/
    /*    padding: 0 !important;*/
    /*}*/

    /*.modal-content{*/
    /*    width: 100% !important;*/
    /*}*/
</style>
@section('content')
    <div class="instructor-profile-right-part instructor-upload-course-box-part">
        <div class="instructor-upload-course-box">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div id="msform">
                            <!-- progressbar -->
                            <ul id="progressbar"
                                class="upload-course-item-block d-flex align-items-center justify-content-center">
                                <li class="active" id="account"><strong>{{ __('Course Overview') }}</strong></li>
                                <li id="personal"><strong>{{ __('Upload Video') }}</strong></li>
                                <li id="instructor"><strong>{{ __('Collaboration') }}</strong></li>
                                <li id="confirm"><strong>{{ __('Submit Course for Review') }}</strong></li>
                            </ul>

                            <div class="upload-course-step-item upload-course-overview-step-item">
                                <!-- Upload Course Overview-2 start -->
                                <form method="POST" action="{{route('course.update.category', [$course->uuid])}}"
                                      enctype="multipart/form-data" class="row g-3 needs-validation" novalidate>
                                    @csrf
                                    <div id="upload-course-overview-2">

                                        <div class="upload-course-item-block course-overview-step1 radius-8">
                                            <div class="upload-course-item-block-title mb-3">
                                                <h6 class="font-20">{{ __('Category & Tags') }}</h6>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-12 mb-30">
                                                    <label
                                                            class="label-text-title color-heading font-medium font-16 mb-3">{{
                                                    __('Course Category') }}
                                                    </label>
                                                    <select name="category_id" id="category_id" class="form-select"
                                                            required>
                                                        <option value="">{{ __('Select Category') }}</option>
                                                        @foreach($categories as $category)
                                                            <option value="{{$category->id}}" @if(old('category_id'))
                                                                {{old('category_id')==$category->id ? 'selected' : '' }}
                                                                    @else
                                                                {{ $course->category_id == $category->id ? 'selected' : '' }}
                                                                    @endif >{{$category->name}}</option>
                                                        @endforeach
                                                    </select>

                                                    @if ($errors->has('category_id'))
                                                        <span class="text-danger"><i
                                                                    class="fas fa-exclamation-triangle"></i> {{
                                                    $errors->first('category_id') }}</span>
                                                    @endif

                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12 mb-30">
                                                    <label
                                                            class="label-text-title color-heading font-medium font-16 mb-3">{{
                                                    __('Course Subcategory') }}
                                                    </label>
                                                    <select name="subcategory_id" id="subcategory_id"
                                                            class="form-select"
                                                            required>
                                                        <option value="">{{ __('Select Subcategory') }}</option>
                                                        @foreach($subcategories as $subcategory)
                                                            <option value="{{$subcategory->id}}" {{$subcategory->id ==
                                                        $course->subcategory_id ? 'selected' : '' }}
                                                            >{{$subcategory->name}}</option>
                                                        @endforeach
                                                    </select>

                                                    @if ($errors->has('subcategory_id'))
                                                        <span class="text-danger"><i
                                                                    class="fas fa-exclamation-triangle"></i> {{
                                                    $errors->first('subcategory_id') }}</span>
                                                    @endif

                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12 mb-30">
                                                    <label
                                                            class="label-text-title color-heading font-medium font-16 mb-3">{{
                                                    __('Tags') }}
                                                    </label>
                                                    <select name="tag[]" class="select2" multiple>
                                                        @foreach($tags as $tag)
                                                            <option value="{{$tag->id}}"
                                                                    @if(in_array($tag->id, $selected_tags))
                                                                        selected @endif>{{$tag->name}}</option>
                                                        @endforeach
                                                    </select>

                                                    @if ($errors->has('tag'))
                                                        <span class="text-danger"><i
                                                                    class="fas fa-exclamation-triangle"></i> {{
                                                    $errors->first('tag') }}</span>
                                                    @endif

                                                </div>
                                            </div>
                                        </div>
                                        <div class="upload-course-item-block course-overview-step1 radius-8">
                                            <div class="upload-course-item-block-title mb-3">
                                                <h6 class="font-20">{{ __('Learners Accessibility & others') }}</h6>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-12 mb-30">
                                                    <label class="label-text-title color-heading font-medium font-16 mb-3">{{ __('Request course as') }}
                                                    </label>
                                                    <select name="status" class="form-select status" required>
                                                        @php
                                                            $status = old('status', $course->status);
                                                        @endphp
                                                        <option value="{{ STATUS_UPCOMING_REQUEST }}" {{ (in_array($status, [STATUS_UPCOMING_REQUEST, STATUS_UPCOMING_APPROVED])) ? 'selected' : '' }}>{{ __('Upcoming') }}</option>
                                                        <option value="{{ STATUS_APPROVED }}" {{ (in_array($status, [STATUS_APPROVED,STATUS_REJECTED,STATUS_HOLD,STATUS_SUSPENDED,STATUS_DELETED])) ? 'selected' : '' }}>{{ __('Publish') }}</option>
                                                    </select>
                                                    <div class="form-text">
                                                        {{ __('If you select as upcoming then it will be show as upcoming in frontend after approval.') }}
                                                    </div>
                                                </div>
                                            </div>

                                            @if($course->course_type == COURSE_TYPE_GENERAL)
                                                <div class="row">
                                                    <div class="col-md-12 mb-30">
                                                        <label
                                                                class="label-text-title color-heading font-medium font-16 mb-3">{{
                                                    __('Drip Content') }}
                                                        </label>
                                                        <select name="drip_content" class="form-select drip_content"
                                                                required>
                                                            <option value="{{ DRIP_SHOW_ALL }}" {{ (old('drip_content',
                                                        $course->drip_content) == DRIP_SHOW_ALL ) ? 'selected' : ''
                                                        }}>{{ dripType(DRIP_SHOW_ALL) }}</option>
                                                            <option value="{{ DRIP_SEQUENCE }}" {{ (old('drip_content',
                                                        $course->drip_content) == DRIP_SEQUENCE ) ? 'selected' : ''
                                                        }}>{{ dripType(DRIP_SEQUENCE) }}</option>
                                                            <option value="{{ DRIP_AFTER_DAY }}" {{ (old('drip_content',
                                                        $course->drip_content) == DRIP_AFTER_DAY ) ? 'selected' : ''
                                                        }}>{{ dripType(DRIP_AFTER_DAY) }}</option>
                                                            <option value="{{ DRIP_UNLOCK_DATE }}" {{ (old('drip_content',
                                                        $course->drip_content) == DRIP_UNLOCK_DATE ) ? 'selected' : ''
                                                        }}>{{ dripType(DRIP_UNLOCK_DATE) }}</option>
                                                            <option value="{{ DRIP_PRE_IDS }}" {{ (old('drip_content', $course->
                                                        drip_content) == DRIP_PRE_IDS ) ? 'selected' : ''
                                                        }}>{{ dripType(DRIP_PRE_IDS) }}</option>
                                                        </select>
                                                        <div id="drip-help-text-{{ DRIP_SHOW_ALL }}"
                                                             class="d-none drip-help-text form-text">
                                                            {{ dripTypeHelpText(DRIP_SHOW_ALL) }}
                                                        </div>
                                                        <div id="drip-help-text-{{ DRIP_SEQUENCE }}"
                                                             class="d-none drip-help-text form-text">
                                                            {{ dripTypeHelpText(DRIP_SEQUENCE) }}
                                                        </div>
                                                        <div id="drip-help-text-{{ DRIP_AFTER_DAY }}"
                                                             class="d-none drip-help-text form-text">
                                                            {{ dripTypeHelpText(DRIP_AFTER_DAY) }}
                                                        </div>
                                                        <div id="drip-help-text-{{ DRIP_UNLOCK_DATE }}"
                                                             class="d-none drip-help-text form-text">
                                                            {{ dripTypeHelpText(DRIP_UNLOCK_DATE) }}
                                                        </div>
                                                        <div id="drip-help-text-{{ DRIP_PRE_IDS }}"
                                                             class="d-none drip-help-text form-text">
                                                            {{ dripTypeHelpText(DRIP_PRE_IDS) }}
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif

                                            <div class="row">
                                                <div class="col-md-12 mb-30">
                                                    <label
                                                            class="label-text-title color-heading font-medium font-16 mb-3">{{
                                                    __('Course Access Period') }}
                                                    </label>
                                                    <input type="number" name="access_period"
                                                           value="{{old('access_period', $course->access_period)}}"
                                                           min="0"
                                                           class="form-control"
                                                           placeholder="{{  __('If there is no expiry duration, leave the field blank.')}} "
                                                    >

                                                    @if ($errors->has('access_period'))
                                                        <span class="text-danger"><i
                                                                    class="fas fa-exclamation-triangle"></i> {{
                                                    $errors->first('access_period') }}</span>
                                                    @endif
                                                    <div class="form-text">
                                                        {{ __('Enrollment will expire after this number of days. Set 0 for no expiration') }}
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-12 mb-30">
                                                    <label
                                                            class="label-text-title color-heading font-medium font-16 mb-3">{{
                                                    __('Learners Accessibility') }}
                                                        <span
                                                                class="cursor tooltip-show-btn share-referral-big-btn primary-btn get-referral-btn border-0"
                                                                data-toggle="popover" data-bs-placement="bottom"
                                                                data-bs-content="">
                                                        !
                                                    </span>
                                                    </label>
                                                    <select name="learner_accessibility"
                                                            class="form-select learner_accessibility" required>
                                                        <option value="">{{ __('Select Option') }}</option>
                                                        <option value="paid" @if(old('learner_accessibility'))
                                                            {{old('learner_accessibility')=='paid' ? 'selected' : '' }}
                                                                @else
                                                            {{ $course->learner_accessibility == 'paid' ? 'selected' :
                                                                                                                   '' }}
                                                                @endif >{{__('Paid')}}</option>
                                                        <option value="free" @if(old('learner_accessibility'))
                                                            {{old('learner_accessibility')=='free' ? 'selected' : '' }}
                                                                @else
                                                            {{ $course->learner_accessibility == 'free' ? 'selected' :
                                                                                                                   '' }}
                                                                @endif >{{__('Free')}}</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="row priceDiv">
                                                <div class="col-md-12 mb-30">
                                                    <label
                                                            class="label-text-title color-heading font-medium font-16 mb-3">{{
                                                    __('Course Price') }}
                                                        <span
                                                                class="cursor tooltip-show-btn share-referral-big-btn primary-btn get-referral-btn border-0"
                                                                data-toggle="popover" data-bs-placement="bottom"
                                                                data-bs-content="">
                                                        !
                                                    </span>
                                                    </label>
                                                    <input type="number" name="price"
                                                           value="{{$course->price == '0' ? '' : $course->price}}"
                                                           min="1"
                                                           maxlength="11" class="form-control price" placeholder="price"
                                                           required="required">

                                                    @if ($errors->has('price'))
                                                        <span class="text-danger"><i
                                                                    class="fas fa-exclamation-triangle"></i> {{
                                                    $errors->first('price') }}</span>
                                                    @endif

                                                </div>
                                                <div class="col-md-12 mb-30">
                                                    <label
                                                            class="label-text-title color-heading font-medium font-16 mb-3">{{
                                                    __('Old Price') }}
                                                        <span
                                                                class="cursor tooltip-show-btn share-referral-big-btn primary-btn get-referral-btn border-0"
                                                                data-toggle="popover" data-bs-placement="bottom"
                                                                data-bs-content="">
                                                        !
                                                    </span>
                                                    </label>
                                                    <input type="number" name="old_price"
                                                           value="{{$course->old_price == '0' ? '' : $course->old_price}}"
                                                           min="1"
                                                           maxlength="11" class="form-control old_price"
                                                           placeholder="Old Price"
                                                           required="required">

                                                    @if ($errors->has('old_price'))
                                                        <span class="text-danger"><i
                                                                    class="fas fa-exclamation-triangle"></i> {{
                                                    $errors->first('old_price') }}</span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-12 mb-30">
                                                    <label
                                                            class="label-text-title color-heading font-medium font-16 mb-3">{{
                                                    __('Language') }}
                                                        <span
                                                                class="cursor tooltip-show-btn share-referral-big-btn primary-btn get-referral-btn border-0"
                                                                data-toggle="popover" data-bs-placement="bottom"
                                                                data-bs-content="">
                                                        !
                                                    </span>
                                                    </label>
                                                    <select name="course_language_id" id="course_language_id"
                                                            class="form-select" required>
                                                        <option value="">Select Language</option>
                                                        @foreach($course_languages as $course_language)
                                                            <option value="{{$course_language->id}}"
                                                            @if(old('course_language_id'))
                                                                {{old('course_language_id')==$course_language->id ? 'selected' :
                                                                '' }}
                                                                    @else
                                                                {{ $course->course_language_id ==
                                                                                                                       $course_language->id ? 'selected' : '' }}
                                                                    @endif
                                                            >{{$course_language->name}}</option>
                                                        @endforeach
                                                    </select>
                                                    @if ($errors->has('course_language_id'))
                                                        <span class="text-danger"><i
                                                                    class="fas fa-exclamation-triangle"></i> {{
                                                    $errors->first('course_language_id') }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12 mb-30">
                                                    <label
                                                            class="label-text-title color-heading font-medium font-16 mb-3">{{
                                                    __('Difficulty Level') }}
                                                        <span
                                                                class="cursor tooltip-show-btn share-referral-big-btn primary-btn get-referral-btn border-0"
                                                                data-toggle="popover" data-bs-placement="bottom"
                                                                data-bs-content="">
                                                        !
                                                    </span>
                                                    </label>
                                                    <select name="difficulty_level_id" id="difficulty_level_id"
                                                            class="form-select" required>
                                                        <option value="">{{ __('Select Difficulty Level') }}</option>
                                                        @foreach($difficulty_levels as $difficulty_level)
                                                            <option value="{{$difficulty_level->id}}"
                                                            @if(old('difficulty_level_id'))
                                                                {{old('difficulty_level_id')==$difficulty_level->id ? 'selected'
                                                                : '' }}
                                                                    @else
                                                                {{ $course->difficulty_level_id ==
                                                                                                                       $difficulty_level->id ? 'selected' : '' }}
                                                                    @endif
                                                            >{{$difficulty_level->name}}</option>
                                                        @endforeach
                                                    </select>

                                                    @if ($errors->has('difficulty_level_id'))
                                                        <span class="text-danger"><i
                                                                    class="fas fa-exclamation-triangle"></i> {{
                                                    $errors->first('difficulty_level_id') }}</span>
                                                    @endif

                                                </div>
                                            </div>
                                            <div class="row align-items-center">
                                                <div class="col-12">
                                                    <label
                                                            class="label-text-title color-heading font-medium font-16 mb-3">{{
                                                    __('Course Thumbnail') }}
                                                        <span
                                                                class="cursor tooltip-show-btn share-referral-big-btn primary-btn get-referral-btn border-0"
                                                                data-toggle="popover" data-bs-placement="bottom"
                                                                data-bs-content="">
                                                        !
                                                    </span>
                                                    </label>
                                                </div>
                                                <div class="col-md-6 mb-30">
                                                    <div class="upload-img-box mt-3 height-200 custom_border">
                                                        @if($course->image)
                                                            <img src="{{getImageFile($course->image)}}" class="show-image custom_border">
                                                        @else
                                                            <img src="{{ asset('/uploads/default/course.jpg') }}" class="show-image custom_border">
                                                        @endif
                                                        <input type="file" id="fileuploade" name="image" class="image custom_border" accept="image/png, image/jpeg, image/png">
                                                        <input type="hidden" name="image_width">
                                                        <input type="hidden" name="image_height">

                                                        <div class="upload-img-box-icon">
                                                            <i class="fa fa-camera"></i>
                                                            <p class="m-0">{{__('Image')}}</p>
                                                        </div>
                                                    </div>
                                                    @if ($errors->has('image'))
                                                        <span class="text-danger"><i
                                                                    class="fas fa-exclamation-triangle"></i> {{
                                                    $errors->first('image') }}</span>
                                                    @endif
                                                </div>
                                                <div class="col-md-6 mb-30">
                                                    <p class="font-12 color-gray text-muted text-xs" style="color: #222222;font-size: 14.4px;font-family: montserrat !important;">
                                                        Select a Main Image for Your Course <br>
                                                        Accepted Image Files JPEG, JPG PNG<br>
                                                        Approved Minimum Image Size: 1200 x 800 px.<br>
                                                        Approved Recommended Image Size: 1500 x 1000 px.<br>
                                                        Approved Maximum Image Size: 5000 x 5000 px.
                                                    </p>
                                                    <p class="font-14 color-gray"></p>
                                                </div>
                                            </div>
                                            <div class="row align-items-center">
                                                <div class="col-12">
                                                    <label class="label-text-title color-heading font-medium font-16 mb-3">{{ __('Course Introduction Video') }}
                                                        ({{ __('Optional') }})</label>
                                                </div>
                                                <div class="col-md-12 mb-30">
                                                    <input type="radio"
                                                           {{ $course->intro_video_check == 1 ? 'checked' : ''}} id="video_check"
                                                           class="intro_video_check" name="intro_video_check" value="1">
                                                    <label for="video_check">{{ __('Video Upload') }}</label><br>
{{--                                                    <input type="radio"--}}
{{--                                                           {{ $course->intro_video_check == 2 ? 'checked' : ''}} id="youtube_check"--}}
{{--                                                           class="intro_video_check" name="intro_video_check" value="2">--}}
{{--                                                    <label for="youtube_check">{{ __('Youtube Video') }}--}}
{{--                                                        ({{ __('write only video Id') }})</label><br>--}}
                                                </div>
                                                <div class="col-md-12 mb-30">
                                                    <input type="file" name="video" id="video" accept="video/mp4"
                                                           class="form-control d-none">
                                                    <input type="text" name="youtube_video_id" id="youtube_video_id"
                                                           placeholder="{{ __('Type your youtube video ID') }}"
                                                           value="{{ $course->youtube_video_id }}"
                                                           class="form-control d-none">
                                                </div>
                                                @if($course->video)
                                                    <div class="col-md-12 mb-30 d-none videoSource">
                                                        <div class="video-player-area ">
                                                            <video id="player" playsinline controls
                                                                   data-poster="{{ getImageFile(@$course->image) }}"
                                                                   controlsList="nodownload">
                                                                <source src="{{ getVideoFile(@$course->video) }}"
                                                                        type="video/mp4">
                                                            </video>
                                                        </div>
                                                    </div>
                                                @endif
                                                @if($course->youtube_video_id)
                                                    <div class="col-md-12 mb-30 d-none videoSourceYoutube">
                                                        <div class="video-player-area ">
                                                            <div class="plyr__video-embed" id="playerVideoYoutube">
                                                                <iframe
                                                                        src="https://www.youtube.com/embed/{{ @$course->youtube_video_id }}"
                                                                        allowfullscreen allowtransparency
                                                                        allow="autoplay">
                                                                </iframe>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif

                                                @if ($errors->has('video'))
                                                    <span class="text-danger"><i
                                                                class="fas fa-exclamation-triangle"></i> {{
                                                $errors->first('video') }}</span>
                                                @endif
                                            </div>

                                        </div>

                                        <a href="{{route('instructor.course.edit', [$course->uuid, 'step=overview'])}}"
                                           class="theme-btn theme-button3 show-last-phase-back-btn">{{__('Back')}}</a>
                                        <button type="submit" class="theme-btn default-hover-btn theme-button1">{{__('Save
                                        and continue')}}</button>

                                    </div>
                                </form>
                                <!-- Upload Course Overview-2 end -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <x-cropper-modal></x-cropper-modal>
@endsection

@push('style')
    <link rel="stylesheet" href="{{asset('common/css/select2.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/assets/css/custom/img-view.css')}}">
    <!-- Video Player css -->
    <link rel="stylesheet" href="{{ asset('frontend/assets/vendor/video-player/plyr.css') }}">
@endpush

@push('script')

    <script src="{{asset('common/js/select2.min.js')}}"></script>
    <script src="{{asset('frontend/assets/js/custom/img-view.js')}}"></script>
    <script src="{{asset('frontend/assets/js/custom/upload-course.js')}}"></script>

    <!-- Video Player js -->
    <script src="{{ asset('frontend/assets/vendor/video-player/plyr.js') }}"></script>
    <script>
        const sm_player1 = new Plyr('#playerVideoYoutube');
    </script>
    <!-- Video Player js -->

    <script>
        "use strict"
        $(function () {
            var intro_video_check = "{{ $course->intro_video_check }}";
            introVideoCheck(intro_video_check);
        })
        $(".intro_video_check").click(function () {
            var intro_video_check = $("input[name='intro_video_check']:checked").val();
            introVideoCheck(intro_video_check);
        });

        function introVideoCheck(intro_video_check) {
            if (intro_video_check == 1) {
                $('#video').removeClass('d-none');
                $('.videoSource').removeClass('d-none');
                $('.videoSourceYoutube').addClass('d-none');
                $('#youtube_video_id').addClass('d-none');
            }

            if (intro_video_check == 2) {
                $('#video').addClass('d-none');
                $('.videoSource').addClass('d-none');
                $('.videoSourceYoutube').removeClass('d-none');
                $('#youtube_video_id').removeClass('d-none');
            }
        }


        $(document).on('change', ':input[name=drip_content]', function () {
            let dripValue = $(':input[name=drip_content]').val();
            $('.drip-help-text').addClass('d-none');
            $('#drip-help-text-' + dripValue).removeClass('d-none');
        });

        $(':input[name=drip_content]').trigger('change');
    </script>

    <!-- Video Player js -->
    <script src="{{ asset('frontend/assets/vendor/video-player/plyr.js') }}"></script>
    <script>
        const aysha_player = new Plyr('#player');
        const aysha_player2 = new Plyr('#youtubePlayer');
    </script>
    <script>
        var $modal = $('#modal');
        var image = document.getElementById('image');
        var cropper;

        let IsCroppingMaximum = true

        /* Image Change Event */
        $("body").on("change", ".image", function (e) {
            var files = e.target.files;

            var done = function (url) {
                image.src = url;

                // Get image dimensions
                var img = new Image();
                img.src = url;

                img.onload = function () {
                    // if(img.width > img.height){
                    //     // horizontally
                    //     $("#parent-div").css({"margin":"0 30px"});
                    // }else{
                    //     //vertically
                    //     $("#parent-div").css({"margin": "30px 0"});
                    // }
                    // Check if image size is exactly 1200x800
                    if (img.width > 5000 || img.height > 5000) {
                        Swal.fire({
                            title: "<b>Notification from the Global Education Platform!</b><hr class='text-dark'>",
                            html: "<p class='font-bold'><i>Thank You for the Image Update!</i></p><p class='text-xs text-danger font-bold'>Approved Minimum Image Size: 1200 x 800 px!</p><p class='text-xs text-danger font-bold'>Approved Maximum Image Size: 5000 x 5000 px!</p><p class='font-bold'><i>Best Regards!</i></p>",
                        });
                        $('.image').val('');
                    }else if (img.width >= 1500 && img.height >= 1000) {
                        IsCroppingMaximum = true
                        $modal.modal('show');
                        $("input[name='image_width']").val(1500);
                        $("input[name='image_height']").val(1000);

                    }else if (img.width >= 1200 && img.height >= 800) {
                        IsCroppingMaximum = false
                        $modal.modal('show');
                        $("input[name='image_width']").val(1200);
                        $("input[name='image_height']").val(800);
                    } else {
                        Swal.fire({
                            title: "<b>Notification from the Global Education Platform!</b><hr class='text-dark'>",
                            html: "<p class='font-bold'><i>Thank You for the Image Update!</i></p><p class='text-xs text-danger font-bold'>Approved Minimum Image Size: 1200 x 800 px!</p><p class='text-xs text-danger font-bold'>Approved Maximum Image Size: 5000 x 5000 px!</p><p class='font-bold'><i>Best Regards!</i></p>",
                        });
                        $('.image').val('');
                    }
                };
            };

            var reader;
            var file;
            var url;

            if (files && files.length > 0) {
                file = files[0];

                if (URL) {
                    done(URL.createObjectURL(file));
                } else if (FileReader) {
                    reader = new FileReader();
                    reader.onload = function (e) {
                        done(reader.result);
                    };
                    reader.readAsDataURL(file);
                }
            }
        });

        /* Show Model Event */
        $modal.on('shown.bs.modal', function () {

            const imageWidth = image.width;
            const imageHeight = image.height;

            const shorterSide = Math.min(imageWidth, imageHeight);
            const minCropBoxShorterSide = shorterSide * 0.1; // 10% of the shorter side
            const minCropBoxLongerSide = minCropBoxShorterSide * (3 / 2); // Apply the 3:2 aspect ratio

            const minCropBoxWidth = imageWidth > imageHeight ? minCropBoxLongerSide : minCropBoxShorterSide;
            const minCropBoxHeight = imageHeight > imageWidth ? minCropBoxLongerSide : minCropBoxShorterSide;


            const maxCropBoxLongerSide = Math.max(imageWidth, imageHeight) * 0.9; // 90% of the longer side
            const maxCropBoxShorterSide = maxCropBoxLongerSide * (2 / 3); // Apply the 3:2 aspect ratio

            const maxCropBoxWidth = imageWidth > imageHeight ? maxCropBoxLongerSide : maxCropBoxShorterSide;
            const maxCropBoxHeight = imageHeight > imageWidth ? maxCropBoxLongerSide : maxCropBoxShorterSide;

            // Set up the cropper
            cropper = new Cropper(image, {
                aspectRatio: 1.5, // 3:2 aspect ratio for 1200x800
                viewMode: 1, // Set viewMode to 1 to cover the entire image
                preview: '.preview',
                autoCropArea: 0, // Ensure the cropper covers the entire image
                cropBoxResizable: true, // Enable resizing for images larger than 1200x800
                dragMode: 'none', // Allow moving the entire image
                center:true,
                scale:'fit',
                minCropBoxWidth: minCropBoxWidth,
                minCropBoxHeight: minCropBoxHeight,
                maxCropBoxWidth: maxCropBoxWidth,
                maxCropBoxHeight: maxCropBoxHeight,
                background:false,
            });
        }).on('hidden.bs.modal', function () {
            // Destroy the cropper when the modal is hidden
            if (cropper) {
                cropper.destroy();
                cropper = null;
            }
            $('.image').val('');
        });

        /* Crop Button Click Event */
        $("#crop").click(function () {
            // Check if the cropper is initialized
            if (cropper) {
                // Get the cropped canvas
                var canvas = cropper.getCroppedCanvas({
                    width: (IsCroppingMaximum ? 1500 : 1200),
                    height: (IsCroppingMaximum ? 1000 : 800),
                });

                // Convert the cropped image to base64
                canvas.toBlob(function (blob) {
                    URL.createObjectURL(blob);

                    // Convert the cropped image to base64
                    var reader = new FileReader();
                    reader.readAsDataURL(blob);
                    reader.onloadend = function () {
                        var base64data = reader.result;

                        // Show the cropped image
                        $(".show-image").show();
                        $(".show-image").attr("src", base64data);

                        const formData = new FormData();
                        formData.append('image_base64', base64data);
                        formData.append('image_width', $("input[name='image_width']").val());
                        formData.append('image_height', $("input[name='image_height']").val());
                        saveBase64Image("{{ route('instructor.course.saveImage',[$course->uuid]) }}",formData,$modal)
                    }
                });
            }
        });
    </script>
    <!-- Video Player js -->
@endpush
