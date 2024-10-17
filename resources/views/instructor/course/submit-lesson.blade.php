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
    .CheckMsg
    {
        font-family: Arial, sans-serif;font-size: 19px;font-weight:500;color:black;padding: 5px  
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
                            <ul id="progressbar" class="upload-course-item-block d-flex align-items-center justify-content-center">
                                <li class="active" id="account"><strong>{{ __('Course Overview') }}</strong></li>
                                <li class="active"  id="personal"><strong>{{ __('Upload Video') }}</strong></li>
                                <li class="active"><strong>{{ __('Collaboration') }}</strong></li>
                                <li  class="active" id="confirm"><strong>{{ __('Submit Course for Reviews') }}</strong></li>
                            </ul>

                            <!-- Upload Course Step-1 Item Start -->
                            <div class="upload-course-step-item upload-course-overview-step-item">
                                <!-- Upload Course Step-3 Item Start -->
                                <div class="upload-course-step-item">
                                    <div class="upload-course-item-block course-overview-step1 radius-8 p-0">
                                        <div class="p-5">
                                            <div class="last-step-content-wrap">
                                                @if (session()->has('updatecourse'))
                                                <div id="confirmation-message" style="text-align:center;">
                                                    <p style="font-family: Arial, sans-serif;font-size: 22px;font-weight:600; color:rgb(34, 95, 5)" class="m-4">Thank You for Updating Your Educational Course!</p>
                                                    <p class="CheckMsg">Our Specialists Be Sure to Check Your Educational Course for Compliance with the Requirements of Our LeoSystem Educational Community.</p>
                                                    <p class="CheckMsg">Expect Course Verification Information Via Email and Personal Messages on Our Global Education Platform!</p>
                                             
                                                <div class="stepper-action-btns mt-3">
                                                    <a href="{{route('instructor.course')}}" class="theme-btn theme-button3">{{__('Cancel')}}</a>
                                                    @if($course->status == 1)
                                                    <a href="{{route('course.upload-finished', [$course->uuid])}}" type="button" class="theme-btn theme-button1">{{ __('Done') }}</a>
                                                    @else
                                                    <a href="{{route('course.upload-finished', [$course->uuid])}}"id="submitForReview" type="button" class="theme-btn theme-button1">{{ __('Submit Course for Review') }}</a>
                                                    @endif
                                                </div>
                                                </div>
                                                @else
                                                <div id="confirmation-message" style="text-align:center;">
                                                    <p style="font-family: Arial, sans-serif;font-size: 22px;font-weight:600; color:rgb(34, 95, 5)" class="m-4">Thank You for Creating a New Educational Course!</p>
                                                    <p class="CheckMsg">Our Specialists Be Sure to Check Your Educational Course for Compliance with the Requirements of Our LeoSystem Educational Community.</p>
                                                    <p class="CheckMsg">Expect Course Verification Information Via Email and Personal Messages on Our Global Education Platform!</p>
                                             
                                                <div class="stepper-action-btns mt-3">
                                                    <a href="{{route('instructor.course')}}" class="theme-btn theme-button3">{{__('Cancel')}}</a>
                                                    @if($course->status == 1)
                                                    <a href="{{route('course.upload-finished', [$course->uuid])}}" type="button" class="theme-btn theme-button1">{{ __('Done') }}</a>
                                                    @else
                                                    <a href="{{route('course.upload-finished', [$course->uuid])}}"id="submitForReview" type="button" class="theme-btn theme-button1">{{ __('Submit Course for Review') }}</a>
                                                    @endif
                                                </div>
                                                </div>
                                                @endif
                                                <div id="verification" class="verification" style="text-align: center;">
                                                    <p style="font-family: Arial, sans-serif;font-size: 22px;font-weight:600; color:rgb(34, 95, 5)" class="m-4">Thank you! Your Educational Course Has Been Sent Succesfully! </p>
                                                    <div class="verification-message">
                                                        <p class="CheckMsg">Expect Course Verification Information Via Email<br>and Personal Messages on Our Global Education Platform!</p>
                                                        <p class="CheckMsg"><strong>Best Regards!</strong></p>
                                                    </div>
                                                    
                                             
                                                {{-- <div class="stepper-action-btns mt-3">
                                                    <a href="{{route('instructor.course')}}" class="theme-btn theme-button3">{{__('Cancel')}}</a>
                                                    @if($course->status == 1)
                                                    <a href="{{route('course.upload-finished', [$course->uuid])}}" type="button" class="theme-btn theme-button1">{{ __('Done') }}</a>
                                                    @else
                                                    <a href="{{route('course.upload-finished', [$course->uuid])}}" type="button" class="theme-btn theme-button1">{{ __('Submit for review') }}</a>
                                                    @endif
                                                </div> --}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Upload Course Step-3 Item End -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
   
@endsection
@push('script')
<script>
    document.getElementById('verification').style.display = 'none';
    document.getElementById('submitForReview').addEventListener('click', function() {
        event.preventDefault();
        window.location.href = this.href;
        document.getElementById('confirmation-message').style.display = 'none';
        document.getElementById('verification').style.display = 'block';
        
    });
</script>
@endpush