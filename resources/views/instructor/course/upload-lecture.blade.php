@extends('layouts.instructor')

@section('breadcrumb')
<div class="page-banner-content text-center">
    <h3 class="page-banner-heading text-white pb-15"> {{__('Upload Course')}} </h3>

    <!-- Breadcrumb Start-->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb justify-content-center">
            <li class="breadcrumb-item font-14"><a href="{{route('instructor.dashboard')}}">{{__('Dashboard')}}</a></li>
            <li class="breadcrumb-item font-14"><a href="{{ route('instructor.course') }}">{{__('My Courses')}}</a></li>
            <li class="breadcrumb-item font-14 active" aria-current="page">{{__('Upload Course')}}</li>
        </ol>
    </nav>
</div>
@endsection

<style>

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
        max-width: 100%;
    }

    .img-container img {
        width: 100%;
        height: 100%;
        object-fit: cover !important;
    }

    .modal-lg {
        max-width: 1000px !important;
    }

    .modal-content{
        width: auto !important;
    }

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
                            <li class="active" id="personal"><strong>{{ __('Upload Video') }}</strong></li>
                            <li id="instructor"><strong>{{ __('Collaboration') }}</strong></li>
                            <li id="confirm"><strong>{{ __('Submit Course for Review') }}</strong></li>
                        </ul>

                        <!-- Upload Course Step-1 Item Start -->
                        <div class="upload-course-step-item upload-course-overview-step-item">
                            <!-- Upload Course Step-2 Item Start -->
                            <div class="upload-course-step-item upload-course-video-step-item">
                                <form id="lecture_form" method="POST" action="{{route('store.lecture', [$course->uuid, $lesson->uuid])}}"
                                    class="row g-3 needs-validation" novalidate enctype="multipart/form-data">
                                    @csrf
                                    <!-- Upload Course Video-4 start -->
                                    <div id="upload-course-video-4">
                                        <div class="upload-course-item-block course-overview-step1 radius-8">

                                            <div class="row mb-30">
                                                <div class="col-md-12">
                                                    <div class="d-flex">
                                                        <div
                                                            class="label-text-title color-heading font-medium font-16 mb-3 mr-15">
                                                            {{ __('Type') }}: </div>
                                                        <div>
                                                            <label class="mr-15"><input type="radio" name="type" value="video" checked class="lecture-type"> {{ __('Upload Video') }}</label>
                                                            <label class="mr-15"><input type="radio" name="type" value="youtube" class="lecture-type" id="lectureTypeYoutube"> {{ __('Youtube') }} </label>
                                                            @if(env('VIMEO_STATUS') == 'active')
                                                            <label class="mr-15"><input type="radio" name="type" value="vimeo" class="lecture-type">  {{ __('Vimeo') }}</label>
                                                            @endif
                                                            <label class="mr-15"><input type="radio" name="type" value="text" class="lecture-type" id="lectureTypeText"> {{ __('Text') }} </label>
                                                            <label class="mr-15"><input type="radio" name="type" value="image" class="lecture-type" id="lectureTypeImage"> {{ __('Image') }} </label>
                                                            <label class="mr-15"><input type="radio" name="type" value="pdf" class="lecture-type" id="lectureTypePDF"> {{ __('PDF') }} </label>
                                                            <label class="mr-15"><input type="radio" name="type" value="slide_document" class="lecture-type" id="lectureTypePowerpoint"> {{ __('Slide Document') }} </label>
                                                            <label class="mr-15"><input type="radio" name="type" value="audio" class="lecture-type" id="lectureTypeAudio"> {{ __('Audio') }} </label>
                                                            <label class="mr-15"><input type="radio" name="type" value="scrom" class="lecture-type" id="lectureTypeScrom"> {{ __('Scrom') }} </label> 
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="scrom" class="d-none">
                                                    <!-- Upload Course Step-2 Item Start -->
                                                    <div class="upload-course-step-item upload-course-video-step-item">
                                                        @if(isset($course->scorm_course) && request()->get('scorm-upload') != 1)
                                                        
                                                        <div class="row mb-30 mt-25" id="fileDuration">
                                                            <div class="col-md-12">
                                                                <label class="label-text-title color-heading font-medium font-16 mb-3">{{
                                                                    __('Scorm File Duration') }} (00:00:00) <span
                                                                        class="text-danger">*</span></label>
                                                                <input type="text" name="duration"
                                                                    value="{{ $course->scorm_course->duration }}"
                                                                    class="form-control customFileDuration"
                                                                    placeholder="00:00:00" required="required">
                                                                @if ($errors->has('duration'))
                                                                <span class="text-danger"><i class="fas fa-exclamation-triangle"></i> {{
                                                                    $errors->first('duration') }}</span>
                                                                @endif
                                                            </div>
                                                        </div>
                    
                                                        <div class="row">
                                                            <div class="col-md-12 text-center">
                                                                <a target="_blank"
                                                                    href="{{route('student.my-course.show', [$course->slug])}}"
                                                                    class="see-preview-video font-medium font-16">{{
                                                                        __('Preview') }}</a>
                                                                <a href="{{route('instructor.course.edit', [$course->uuid, 'step=lesson', 'scorm-upload=1'])}}"
                                                                    class="common-upload-video-btn color-heading font-13 font-medium ms-0 mt-4"><span
                                                                        class="iconify" data-icon="feather:upload-cloud"></span>{{
                                                                    __('Upload SCORM') }}</a>
                                                            </div>
                                                        </div>
                                                        @else
                                                        <input type="hidden" name="scorm_upload" value="1">
                                                        <div class="row mb-30 mt-25" id="fileDuration">
                                                            <div class="col-md-12">
                                                                <label class="label-text-title color-heading font-medium font-16 mb-3">{{
                                                                    __('Scorm File Duration') }} (00:00:00) <span
                                                                        class="text-danger">*</span></label>
                                                                <input type="text" name="duration" value=""
                                                                    class="form-control customFileDuration"
                                                                    placeholder="00:00:00" required="required">
                                                                @if ($errors->has('duration'))
                                                                <span class="text-danger"><i class="fas fa-exclamation-triangle"></i> {{
                                                                    $errors->first('duration') }}</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <label class="label-text-title color-heading font-medium font-16 mb-3">{{
                                                                    __('Upload
                                                                    SCORM file') }}<span class="text-danger">*</span></label>
                                                                <div
                                                                    class="upload-course-video-4-wrap upload-introduction-box-content-left d-flex align-items-center flex-column">
                                                                    <div class="upload-introduction-box-content-img mb-3">
                                                                        <img src="{{asset('frontend/assets/img/instructor-img/upload-zip-icon.png')}}"
                                                                            alt="upload">
                                                                    </div>
                                                                    <input type="file" name="scorm_file" id="scrom"
                                                                        accept="zip,application/octet-stream,application/zip,application/x-zip,application/x-zip-compressed"
                                                                        class="form-control" value="{{ old('scorm_file') }}" id="scorm_file"
                                                                        title="Upload SCORM" required>
                                                                </div>
                    
                                                                <p class="font-14 color-gray text-center mt-3 pb-30">{{ __('No file
                                                                    selected') }} (zip)
                                                                </p>
                                                            </div>
                                                        </div>
                                                        @endif
                                                    </div>
                                                
                                                    </div>
                                            </div>

                                            <div id="video">
                                                <label
                                                    class="label-text-title color-heading font-medium font-16 mb-3">{{
                                                    __('Upload Video') }}<span class="text-danger">*</span></label>
                                                <div
                                                    class="upload-course-video-4-wrap upload-introduction-box-content-left d-flex align-items-center flex-column">
                                                    <div class="upload-introduction-box-content-img mb-3">
                                                        <img src="{{asset('frontend/assets/img/instructor-img/upload-lesson-icon.png')}}"
                                                            alt="upload">
                                                    </div>
                                                    <input type="hidden" id="file_duration" name="file_duration">
                                                    <input type="file" name="video_file" accept="video/mp4" class="form-control" value="{{ old('video_file') }}" id="video_file" title="{{ __('Upload lesson') }}" required>
                                                </div>

                                                <p class="font-14 color-gray text-center mt-3 pb-30">No file selected
                                                    (MP4 or WMV)</p>
                                            </div>

                                            <div id="youtube" class="d-none">
                                                <label class="label-text-title color-heading font-medium font-16 mb-3">{{ __('Lesson Youtube Video ID') }} <span class="text-danger">*</span></label>
                                                <input type="text" name="youtube_url_path" class="form-control youtube-url" value="{{ old('youtube_url_path') }}" id="youtube_url_path" placeholder="{{ __('Type Your Youtube Video ID') }}">
                                            </div>

                                            <div id="vimeo" class="d-none">
                                                <div class="row mb-30">
                                                    <div class="col-md-12">
                                                        <label
                                                            class="label-text-title color-heading font-medium font-16 mb-3">{{
                                                            __('Vimeo Upload Type') }} <span
                                                                class="text-danger">*</span></label>
                                                        <select name="vimeo_upload_type"
                                                            class="form-select vimeo_upload_type">
                                                            <option value="">--{{ __('Select Option') }}--</option>
                                                            <option value="1" @if(old('vimeo_upload_type')==1) selected
                                                                @endif>{{ __('Video File Upload') }}</option>
                                                            <option value="2" @if(old('vimeo_upload_type')==2) selected
                                                                @endif>{{ __('Vimeo Uploaded Video ID') }}</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="vimeo_Video_file_upload_div d-none">
                                                    <label
                                                        class="label-text-title color-heading font-medium font-16 mb-3">{{
                                                        __('Upload Video') }}<span class="text-danger">*</span></label>
                                                    <div
                                                        class="upload-course-video-4-wrap upload-introduction-box-content-left d-flex align-items-center flex-column">
                                                        <div class="upload-introduction-box-content-img mb-3">
                                                            <img src="{{asset('frontend/assets/img/instructor-img/upload-lesson-icon.png')}}"
                                                                alt="upload">
                                                        </div>
                                                        <input type="file" name="vimeo_url_path" accept="video/mp4"
                                                            class="form-control" value="{{ old('vimeo_url_path') }}"
                                                            id="vimeo_url_path" title="Upload lesson">
                                                    </div>
                                                    @if ($errors->has('vimeo_url_path'))
                                                    <span class="text-danger"><i
                                                            class="fas fa-exclamation-triangle"></i> {{
                                                        $errors->first('vimeo_url_path') }}</span>
                                                    @endif
                                                </div>
                                                <div class="vimeo_uploaded_Video_id_div d-none">
                                                    <div class="row mb-30">
                                                        <div class="col-md-12">
                                                            <label class="label-text-title color-heading font-medium font-16 mb-3">{{ __('Uploaded Video ID') }}<span class="text-danger">*</span></label>
                                                            <div class="upload-course-video-4-wrap upload-introduction-box-content-left d-flex align-items-center flex-column">
                                                                <input type="text" name="vimeo_url_uploaded_path" placeholder="{{ __('Type your uploaded video ID (ex: 123654)') }}" class="form-control" value="{{ old('vimeo_url_uploaded_path') }}" id="vimeo_url_uploaded_path">
                                                            </div>
                                                        </div>
                                                        @if ($errors->has('vimeo_url_uploaded_path'))
                                                        <span class="text-danger"><i
                                                                class="fas fa-exclamation-triangle"></i> {{
                                                            $errors->first('vimeo_url_uploaded_path') }}</span>
                                                        @endif
                                                    </div>
                                                    <div class="row mb-30">
                                                        <div class="col-md-12">
                                                            <label class="label-text-title color-heading font-medium font-16 mb-3">{{ __('Lesson File Duration') }} (00:00) <span class="text-danger">*</span></label>
                                                            <input type="text" name="vimeo_file_duration" value="{{old('vimeo_file_duration')}}" class="form-control customVimeoFileDuration" placeholder="{{ __('Type file duration') }}" >
                                                            @if ($errors->has('vimeo_file_duration'))
                                                            <span class="text-danger"><i
                                                                    class="fas fa-exclamation-triangle"></i> {{
                                                                $errors->first('vimeo_file_duration') }}</span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div id="text" class="d-none">
                                                <label
                                                    class="label-text-title color-heading font-medium font-16 mb-3">{{
                                                    __('Lesson Description') }} <span
                                                        class="text-danger">*</span></label>
                                                <textarea name="text_description" id="summernote"
                                                    class="textDescription" cols="30" rows="10">{{
                                                    old('text_description') }}</textarea>
                                            </div>
                                            <div id="imageDiv" class="d-none">
                                                <div class="row align-items-center">
                                                    <div class="col-12">
                                                        <label
                                                            class="label-text-title color-heading font-medium font-16 mb-3">{{
                                                            __('Lesson Image') }} <span
                                                                class="text-danger">*</span></label>
                                                    </div>
                                                    <div class="col-md-6 mb-30">
                                                        <div class="upload-img-box mt-3 height-200" style="border-radius: 33px;">
{{--                                                            <div class="position-relative">--}}
                                                                <img src="{{ asset('/uploads/default/lecture.jpg') }}" class="show-image" style="border-radius: 33px;">
                                                                <img id="loader" src="{{ asset('frontend/assets/gif/loader.gif') }}" hidden class="position-absolute left-50" style="width: 100px;height: 100px;object-fit: cover;top: 40%;" width="100%" height="100%" alt="loader">

{{--                                                            </div>--}}
                                                            <input type="file" id="fileuploade" name="image" class="image" accept="image/png, image/jpeg, image/png">
                                                            <input type="hidden" name="image_base64">
                                                            <input type="hidden" name="image_width">
                                                            <input type="hidden" name="image_height">
                                                            <div class="upload-img-box-icon">
                                                                <i class="fa fa-camera"></i>
                                                                <p class="m-0">{{__('Image')}}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 mb-30">
                                                        <p class="font-12 color-gray text-muted text-xs">
                                                            {{ __('Select an Image for Your Lesson') }}
                                                        </p>
                                                        <p class="font-12 color-gray text-muted text-xs">{{ __('Accepted Image Files JPEG, JPG PNG') }}: JPEG, JPG PNG</p>
                                                        <p class="font-12 color-gray text-muted text-xs">Approved Minimum Image Size: 1200 x 800 px.</p>
                                                        <p class="font-12 color-gray text-muted text-xs">Approved Recommended Image Size: 1500 x 1000 px.</p>
                                                        <p class="font-12 color-gray text-muted text-xs">Approved Maximum Image Size: 5000 x 5000 px.</p>
                                                        @if ($errors->has('image'))
                                                            <span class="text-danger"><i
                                                                        class="fas fa-exclamation-triangle"></i> {{
                                                            $errors->first('image') }}</span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>

                                            <div id="pdfDiv" class="d-none">
                                                <label
                                                    class="label-text-title color-heading font-medium font-16 mb-3">{{
                                                    __('Upload PDF') }} <span class="text-danger">*</span></label>
                                                <div
                                                    class="upload-course-video-4-wrap upload-introduction-box-content-left d-flex align-items-center flex-column">
                                                    <div class="upload-introduction-box-content-img mb-3">
                                                        <img src="{{asset('frontend/assets/img/instructor-img/upload-lesson-icon.png')}}"
                                                            alt="upload">
                                                    </div>
                                                    <input type="file" name="pdf" accept="application/pdf"
                                                        class="form-control" value="{{ old('pdf') }}" id="pdf"
                                                        title="Upload lesson pdf">
                                                </div>
                                            </div>
                                            <div id="slide_documentDiv" class="d-none">
                                                <label
                                                    class="label-text-title color-heading font-medium font-16 mb-3">{{
                                                    __('Write your Slide Embed Code') }}<span
                                                        class="text-danger">*</span></label>
                                                <div
                                                    class="upload-course-video-4-wrap upload-introduction-box-content-left d-flex align-items-center flex-column">
                                                    <input type="text" name="slide_document" class="form-control"
                                                        value="{{ old('slide_document') }}" id="slide_document"
                                                        title="Upload lesson slide document">
                                                </div>
                                            </div>
                                            <div id="audioDiv" class="d-none">
                                                <label
                                                    class="label-text-title color-heading font-medium font-16 mb-3">{{
                                                    __('Upload Audio') }} <span class="text-danger">*</span></label>
                                                <div
                                                    class="upload-course-video-4-wrap upload-introduction-box-content-left d-flex align-items-center flex-column">
                                                    <div class="upload-introduction-box-content-img mb-3">
                                                        <img src="{{asset('frontend/assets/img/instructor-img/upload-lesson-icon.png')}}"
                                                            alt="upload">
                                                    </div>
                                                    <input type="file" name="audio" class="form-control"
                                                        value="{{ old('audio') }}" id="audio"
                                                        title="Upload lesson audio">
                                                </div>
                                            </div>
                                            <div>
                                                @if ($errors->has('video_file'))
                                                <span class="text-danger"><i class="fas fa-exclamation-triangle"></i> {{
                                                    $errors->first('video_file') }}</span>
                                                @endif
                                                @if ($errors->has('youtube_url'))
                                                <span class="text-danger"><i class="fas fa-exclamation-triangle"></i> {{
                                                    $errors->first('youtube_url') }}</span>
                                                @endif
                                                @if ($errors->has('vimeo_url'))
                                                <span class="text-danger"><i class="fas fa-exclamation-triangle"></i> {{
                                                    $errors->first('vimeo_url') }}</span>
                                                @endif
                                                @if ($errors->has('text_description'))
                                                <span class="text-danger"><i class="fas fa-exclamation-triangle"></i> {{
                                                    $errors->first('text_description') }}</span>
                                                @endif
                                                @if ($errors->has('image'))
                                                <span class="text-danger"><i class="fas fa-exclamation-triangle"></i> {{
                                                    $errors->first('image') }}</span>
                                                @endif
                                                @if ($errors->has('pdf'))
                                                <span class="text-danger"><i class="fas fa-exclamation-triangle"></i> {{
                                                    $errors->first('pdf') }}</span>
                                                @endif
                                                @if ($errors->has('slide_document'))
                                                <span class="text-danger"><i class="fas fa-exclamation-triangle"></i> {{
                                                    $errors->first('slide_document') }}</span>
                                                @endif
                                                @if ($errors->has('audio'))
                                                <span class="text-danger"><i class="fas fa-exclamation-triangle"></i> {{
                                                    $errors->first('audio') }}</span>
                                                @endif
                                            </div>

                                            <div class="main-upload-video-processing-box">
                                                <div class="d-flex main-upload-video-processing-item">
                                                    <div class="flex-grow-1 ms-3">
                                                        <div class="row mb-30">
                                                            <div class="col-md-12">
                                                                <label class="label-text-title color-heading font-medium font-16 mb-3">{{ __('Lesson Title') }} <span class="text-danger">*</span></label>
                                                                <input type="text" name="title" value="{{old('title')}}" class="form-control" placeholder="{{ __('First steps') }}" required>
                                                            </div>
                                                        </div>
                                                        <div class="row mb-30">
                                                            <div class="col-md-12">
                                                                <label
                                                                    class="label-text-title color-heading font-medium font-16 mb-3">{{
                                                                    __('Learner\'s Visibility') }} <span
                                                                        class="text-danger">*</span></label>
                                                                <select name="lecture_type" class="form-select"
                                                                    required>
                                                                    <option value="">--Select Option--</option>
                                                                    <option value="1" @if(old('lecture_type')==1)
                                                                        selected @endif>{{ __('Show') }}</option>
                                                                    <option value="2" @if(old('lecture_type')==2)
                                                                        selected @endif>{{ __('Lock') }}</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="row mb-30 d-none" id="fileDuration">
                                                            <div class="col-md-12">
                                                                <label class="label-text-title color-heading font-medium font-16 mb-3">{{ __('Lesson File Duration') }} (00:00) <span class="text-danger">*</span></label>
                                                                <input type="text" name="youtube_file_duration" value="{{old('file_duration')}}" class="form-control customFileDuration" placeholder="{{ __('First file duration') }}" >
                                                                @if ($errors->has('youtube_file_duration'))
                                                                <span class="text-danger"><i
                                                                        class="fas fa-exclamation-triangle"></i> {{
                                                                    $errors->first('youtube_file_duration') }}</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        @if($course->drip_content == DRIP_AFTER_DAY)
                                                        <div class="row mb-30" id="drip-day">
                                                            <div class="col-md-12">
                                                                <label
                                                                    class="label-text-title color-heading font-medium font-16 mb-3">{{
                                                                    __('Lesson available after x days') }} <span class="text-danger">*</span></label>
                                                                <input type="number" min=1 required name="after_day"
                                                                    value="{{old('unlock_date', 0)}}"
                                                                    class="form-control" placeholder="Days">
                                                                @if ($errors->has('after_day'))
                                                                <span class="text-danger"><i
                                                                        class="fas fa-exclamation-triangle"></i> {{
                                                                    $errors->first('after_day') }}</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        @elseif($course->drip_content == DRIP_UNLOCK_DATE)
                                                        <div class="row mb-30" id="drip-date">
                                                            <div class="col-md-12">
                                                                <div class="input__group text-black">
                                                                    <label
                                                                        class="label-text-title color-heading font-medium font-16 mb-3">{{
                                                                        __('Lesson available by date') }} <span class="text-danger">*</span></label>
                                                                    <input type="date" name="unlock_date"
                                                                        value="{{old('unlock_date')}}"
                                                                        class="form-control" required>
                                                                    @if ($errors->has('unlock_date'))
                                                                    <span class="text-danger"><i
                                                                            class="fas fa-exclamation-triangle"></i> {{
                                                                        $errors->first('unlock_date') }}</span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @elseif($course->drip_content == DRIP_PRE_IDS)
                                                        <div class="row mb-30" id="drip-pre-requisite">
                                                            <div class="col-md-12">
                                                                <label
                                                                    class="label-text-title color-heading font-medium font-16 mb-3">{{
                                                                    __('Pre-requisites lesson') }}
                                                                    <span class="text-danger">*</span>
                                                                </label>
                                                                <select name="pre_ids[]" required class="select2 form-select" multiple>
                                                                    @foreach ($lessons as $pr_lesson)
                                                                    <optgroup label="{{ $pr_lesson->name }}">
                                                                        @foreach ($pr_lesson->lectures as $pr_lecture)
                                                                        <option value="{{ $pr_lecture->id }}">{{ $pr_lecture->title }}</option>
                                                                        @endforeach
                                                                      </optgroup>
                                                                    @endforeach
                                                                </select>

                                                                @if ($errors->has('pre_ids'))
                                                                <span class="text-danger"><i
                                                                        class="fas fa-exclamation-triangle"></i> {{
                                                                    $errors->first('pre_ids') }}</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        @endif
                                                        <div class="row mb-30">
                                                            <div
                                                            class="col-md-12 main-upload-video-processing-item-btns">
                                                            {{-- <button type="submit" id="UploadLectureSubmitId"
                                                                class="theme-btn upload-video-processing-item-save-btn">{{__('Save')}}</button>
                                                            <a href="{{route('instructor.course.edit', [$course->uuid, 'step=lesson'])}}"
                                                                class="theme-btn default-hover-btn default-back-btn theme-button3">{{__('Backo')}}</a> --}}




                                                                <div class="stepper-action-btns">
                                                                    @if(request()->get('scorm-upload') == 1)
                                                                    <a href="{{route('instructor.course.edit', [$course->uuid, 'step=lesson'])}}"
                                                                        class="theme-btn theme-button3">{{__('Back')}}</a>
                                                                    @else
                                                                    <a href="{{route('instructor.course.edit', [$course->uuid, 'step=category'])}}"
                                                                        class="theme-btn theme-button3">{{__('Back')}}</a>
                                                                    @endif
                                                                    <button type="submit" id="UploadLectureSubmitId" class="theme-btn default-hover-btn theme-button1">{{__('Save me
                                                                        and
                                                                        continue')}}</button>
                                                        </div>
                                                    </div>
                                                            {{-- <div
                                                                class="col-md-12 main-upload-video-processing-item-btns">
                                                                <button type="submit" id="UploadLectureSubmitId"
                                                                    class="theme-btn upload-video-processing-item-save-btn">{{__('Save')}}</button>
                                                                <a href="{{route('instructor.course.edit', [$course->uuid, 'step=lesson'])}}"
                                                                    class="theme-btn default-hover-btn default-back-btn theme-button3">{{__('Backo')}}</a>




                                                                    <div class="stepper-action-btns">
                                                                        @if(request()->get('scorm-upload') == 1)
                                                                        <a href="{{route('instructor.course.edit', [$course->uuid, 'step=lesson'])}}"
                                                                            class="theme-btn theme-button3">{{__('Back1')}}</a>
                                                                        @else
                                                                        <a href="{{route('instructor.course.edit', [$course->uuid, 'step=category'])}}"
                                                                            class="theme-btn theme-button3">{{__('Back2')}}</a>
                                                                        @endif
                                                                        <button type="submit" class="theme-btn default-hover-btn theme-button1">{{__('Save
                                                                            and
                                                                            continue')}}</button>
                                                            </div>
                                                        </div> --}}
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <!-- Upload Course Video-4 end -->
                                </form>
                            </div>
                            <!-- Upload Course Step-6 Item End -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <x-cropper-modal cropButtonText="Crop"></x-cropper-modal>

{{--    <div class="modal fade" style="border-radius: 33px;" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">--}}
{{--        <div class="modal-dialog modal-dialog-centered" role="document">--}}
{{--            <div class="modal-content">--}}
{{--                <div class="modal-header">--}}
{{--                    <div>--}}
{{--                        <h5 class="modal-title" id="modalLabel">--}}
{{--                            Processing your image--}}
{{--                        </h5>--}}
{{--                        <p>Please Select the Desired Area of the Image !</p>--}}
{{--                    </div>--}}
{{--                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">--}}
{{--                        <span aria-hidden="true">×</span>--}}
{{--                    </button>--}}
{{--                </div>--}}
{{--                <div class="modal-body d-flex text-center items-center justify-content-center">--}}
{{--                    <div id="parent-div">--}}
{{--                        <img id="image" style="max-height: 380px;object-fit: cover" src="https://avatars0.githubusercontent.com/u/3456749">--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="modal-footer text-center justify-content-center" style="gap: 33px;">--}}
{{--                    <button type="button" class="btn btn-secondary px-5 py-2" style="border-radius: 33px" data-bs-dismiss="modal">Cancel</button>--}}
{{--                    <button type="button" class="btn btn-warning px-5 py-2" style="border-radius: 33px" id="crop">Crop & Save</button>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
</div>
<input type="hidden" value="{{ old('type') }}" class="oldTypeYoutube">
@endsection

@push('style')
<link rel="stylesheet" href="{{asset('frontend/assets/css/custom/img-view.css')}}">

<link rel="stylesheet" href="{{asset('common/css/select2.css')}}">
<!-- Summernote CSS - CDN Link -->
<link href="{{ asset('common/css/summernote/summernote.min.css') }}" rel="stylesheet">
<link href="{{ asset('common/css/summernote/summernote-lite.min.css') }}" rel="stylesheet">
<!-- //Summernote CSS - CDN Link -->
@endpush

@push('script')

<script src="{{asset('common/js/select2.min.js')}}"></script>
<script src="{{asset('frontend/assets/js/custom/form-validation.js')}}"></script>
<script src="{{asset('frontend/assets/js/custom/img-view.js')}}"></script>
<script src="{{asset('frontend/assets/js/custom/upload-lesson.js')}}"></script>

<!-- Summernote JS - CDN Link -->
<script src="{{ asset('common/js/summernote/summernote-lite.min.js') }}"></script>
<script>
    $(document).ready(function() {
        $('.select2').select2();
        $("#summernote").summernote({dialogsInBody: true});
        $('.dropdown-toggle').dropdown();
    });

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
                    // Display the cropping frame
                    Swal.fire({
                        title: "<b>Notification from the Global Education Platform!</b><hr class='text-dark'>",
                            html: "<p class='font-bold'><i>Thank You for the Image Update!</i></p><p class='text-xs text-danger font-bold'>Approved Minimum Image Size: 1200 x 800 px!</p><p class='text-xs text-danger font-bold'>Approved Maximum Image Size: 5000 x 5000 px!</p><p class='font-bold'><i>Best Regards!</i></p>",
                    });
                    $('.image').val('');
                }
                else if (img.width >= 1500 && img.height >= 1000) {
                    // Display the cropping frame
                    IsCroppingMaximum = true
                    $modal.modal('show');
                    $("input[name='image_width']").val(1500);
                    $("input[name='image_height']").val(1000);
                }else if (img.width >= 1200 && img.height >= 800) {
                    IsCroppingMaximum = false
                    $("input[name='image_width']").val(1200);
                    $("input[name='image_height']").val(800);
                    // Display the cropping frame
                    $modal.modal('show');
                } else if (img.width < 1200 || img.height < 800) {
                    // If the image is less than 1200x800, show an alert
                    Swal.fire({
                        title: "<b>Notification from the Global Education Platform!</b><hr class='text-dark'>",
                            html: "<p class='font-bold'><i>Thank You for the Image Update!</i></p><p class='text-xs text-danger font-bold'>Approved Minimum Image Size: 1200 x 800 px!</p><p class='text-xs text-danger font-bold'>Approved Maximum Image Size: 5000 x 5000 px!</p><p class='font-bold'><i>Best Regards!</i></p>",
                    });
                    $('.image').val('');
                } else {
                    IsCroppingMaximum = false
                    // If the image is larger than 1200x800, allow cropping
                    $modal.modal('show');
                }
            };
        };

        var reader;
        var file;

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
        $('#loader').prop('hidden',false)
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
                    $('#loader').prop('hidden',true)
                    var base64data = reader.result;

                    // Set the base64 data to the input field
                    $("input[name='image_base64']").val(base64data);

                    // Show the cropped image
                    $(".show-image").show();
                    $(".show-image").attr("src", base64data);

                    $modal.modal('toggle')
                    // const formData = new FormData();
                    // formData.append('image_base64', base64data);
                    // formData.append('image_width', $("input[name='image_width']").val());
                    // formData.append('image_height', $("input[name='image_height']").val());
{{--                    saveBase64Image("{{route('store.lecture.image', [$course->uuid,$lesson->uuid])}}",formData,$modal)--}}
                }
            });
        }
    });

    $('#UploadLectureSubmitId').click(function () {
       
        $('#loader').prop('hidden',false)
        $("#lecture_form").submit();
    })
</script>
<!-- //Summernote JS - CDN Link -->
@endpush
