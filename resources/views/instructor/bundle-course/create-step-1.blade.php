@extends('layouts.instructor')

@section('breadcrumb')
<div class="page-banner-content text-center">
    <h3 class="page-banner-heading text-white pb-15"> {{ __('Bundles Courses') }} </h3>

    <!-- Breadcrumb Start-->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb justify-content-center">
            <li class="breadcrumb-item font-14"><a href="{{ route('instructor.dashboard') }}">{{ __('Dashboard') }}</a>
            </li>
            <li class="breadcrumb-item font-14 active" aria-current="page">{{ __('Bundles Courses') }}</li>
        </ol>
    </nav>
</div>
@endsection

@section('content')
<div class="instructor-profile-right-part">

    <div class="instructor-create-new-quiz-page instructor-create-assignment-page bg-white">
        <div class="instructor-my-courses-title d-flex justify-content-between align-items-center">
            <h6>{{ __('Create Bundles Courses') }}</h6>
        </div>
        <div class="row">
            <div class="col-12">
                <form class="create-new-quiz-form" action="{{ route('instructor.bundle-course.store')}}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-12 mb-30">
                            <label class="label-text-title color-heading font-medium font-16 mb-3">{{ __('Bundles
                                Courses Name') }} <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="name"
                                placeholder="Enter your bundles courses name">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 mb-30">
                            <label class="label-text-title color-heading font-medium font-16 mb-3">{{
                                __('Bundle Access Period') }}
                            </label>
                            <input type="number" name="access_period" value="{{ old('access_period') }}" min="0"
                                class="form-control"
                                placeholder="{{  __('If there is no expiry duration, leave the field blank.')}} ">

                            @if ($errors->has('access_period'))
                            <span class="text-danger"><i class="fas fa-exclamation-triangle"></i> {{
                                $errors->first('access_period') }}</span>
                            @endif
                            <div class="form-text">
                                {{ __('Enrollment will expire after this number of days. Set 0 for no expiration') }}
                            </div>
                        </div>
                    </div>

                    @if(get_option('subscription_mode'))
                    <div class="row mb-30">
                        <div class="col-md-12">
                            <div class="label-text-title color-heading font-medium font-16 mb-3">{{
                                __('Enable for subscription') }}
                                <span class="text-danger">*</span>
                            </div>

                            <select name="is_subscription_enable" id="is_subscription_enable" class="form-select"
                                required>
                                <option value="{{ PACKAGE_STATUS_ACTIVE }}"
                                    {{old('is_subscription_enable')==PACKAGE_STATUS_ACTIVE ? 'selected' : '' }}>
                                    {{ __("Enable") }}</option>
                                <option value="{{ PACKAGE_STATUS_DISABLED }}"
                                    {{old('is_subscription_enable')==PACKAGE_STATUS_DISABLED ? 'selected' : '' }}>
                                    {{ __("Disabled") }}</option>
                            </select>

                            @if ($errors->has('is_subscription_enable'))
                            <span class="text-danger"><i class="fas fa-exclamation-triangle"></i> {{
                                $errors->first('is_subscription_enable') }}</span>
                            @endif
                        </div>
                    </div>
                    @endif
                    <div class="row mb-30">
                        <div class="col-md-12">
                            <div class="label-text-title color-heading font-medium font-16 mb-3">{{ __('Overview') }}
                                <span class="text-danger">*</span></div>
                            <textarea class="form-control" name="overview" cols="30" rows="10"
                                placeholder="Write your bundles courses overview"></textarea>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-30">
                            <label class="label-text-title color-heading font-medium font-16 mb-3">{{ __('Price') }} {{
                                get_currency_symbol() }} <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" name="price" min="1" step="any"
                                placeholder="Enter your price" value="" required="">
                        </div>

                        <div class="col-md-6 mb-30">
                            <label class="label-text-title color-heading font-medium font-16 mb-3">Status <span
                                    class="text-danger">*</span></label>
                            <select name="status" class="form-control">
                                <option value="">{{ __('Select Option') }}</option>
                                <option value="1">{{ __('Active') }}</option>
                                <option value="0">{{ __('Disable') }}</option>
                            </select>
                        </div>
                    </div>

                    <div class="row align-items-center">
                        <div class="col-12">
                            <label class="label-text-title color-heading font-medium font-16 mb-3">{{ __('Image') }}
                                <span class="text-danger">*</span>
                            </label>
                        </div>
                        <div class="col-md-5 mb-30">
                            <x-cropper-modal></x-cropper-modal>
                            <x-image-cropping />
                            @if ($errors->has('image'))
                            <span class="text-danger"><i class="fas fa-exclamation-triangle"></i> {{
                                $errors->first('image') }}</span>
                            @endif
                        </div>
                        <div class="col-md-6 mb-30">
                            <p class="font-14 color-gray">
                                Accepted Image Files JPEG, JPG PNG<br>
                                Approved Minimum Image Size: 1200 x 800 px.<br>
                                Approved Recommended Image Size: 1500 x 1000 px.<br>
                                Approved Maximum Image Size: 5000 x 5000 px.
                            </p>
                        </div>
                    </div>

                    <div>
                        <a href="{{ route('instructor.bundle-course.index') }}"
                            class="theme-btn theme-button3 quiz-back-btn">{{ __('Back to List') }}</a>
                        <button type="submit" class="theme-btn theme-button1">{{ __('Create & Next') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('style')
<link rel="stylesheet" href="{{asset('frontend/assets/css/custom/img-view.css')}}">
@endpush

@push('script')
<script src="{{asset('frontend/assets/js/custom/img-view.js')}}"></script>

@endpush
