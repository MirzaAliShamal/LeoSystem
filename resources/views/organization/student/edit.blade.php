@extends('layouts.organization')

@section('breadcrumb')
    <div class="page-banner-content text-center">
        <h3 class="page-banner-heading text-white pb-15"> {{ __('Edit Student') }} </h3>

        <!-- Breadcrumb Start-->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb justify-content-center">
                <li class="breadcrumb-item font-14"><a href="{{ route('organization.dashboard') }}">{{ __('Dashboard') }}</a>
                </li>
                <li class="breadcrumb-item font-14 active" aria-current="page">{{ __('Edit Student') }}</li>
            </ol>
        </nav>
    </div>
@endsection

@section('content')
    <div class="instructor-profile-right-part">
        <form method="POST" action="{{ route('organization.student.update', $student->uuid) }}"
            enctype="multipart/form-data" autocomplete="off">
            @csrf
            <div class="instructor-profile-info-box">
                <div class="instructor-my-courses-title d-flex justify-content-between align-items-center">
                    <h6>{{ __('Edit Student') }}</h6>
                </div>
                <div class="row">
                    <div class="col-md-4 mb-30">
                        <div class="upload-img-box mt-3 height-200 custom_border">
{{--                            <img src="{{ asset(@$student->user->image_path) }}">--}}
                            <img src="{{ getImageFile(@$student->user->image) ? getImageFile(@$student->user->image) : asset('uploads/default/reg-default-student.jpg') }}" alt="User Image" class="custom_border" id="circle">
                            <input type="file" id="fileuploade" name="image" class="image" accept="image/*">
                            <input type="hidden" name="image_base64">
                            <div class="upload-img-box-icon">
                                <i class="fa fa-camera"></i>
                                <p class="m-0">{{ __('Image') }}</p>
                            </div>
                        </div>
                        @if ($errors->has('image'))
                            <span class="text-danger"><i class="fas fa-exclamation-triangle"></i>
                                {{ $errors->first('image') }}</span>
                        @endif
                        <div class="author-info">
                            <p class="font-14">{{ __('Accepted Image Files') }}: JPEG, JPG, PNG <br>
                                {{ __('Accepted Size') }}: 300 x 300 (1MB)</p>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-30">
                        <label class="font-medium font-15 color-heading">{{ __('First Name') }} <span
                                class="text-danger">*</span></label>
                        <input type="text" name="first_name" value="{{ $student->first_name }}"
                            placeholder="{{ __('First Name') }}" class="form-control" required>
                        @if ($errors->has('first_name'))
                            <span class="text-danger"><i class="fas fa-exclamation-triangle"></i>
                                {{ $errors->first('first_name') }}</span>
                        @endif
                    </div>
                    <div class="col-md-6 mb-30">
                        <label class="font-medium font-15 color-heading">{{ __('Last Name') }} <span
                                class="text-danger">*</span></label>
                        <input type="text" name="last_name" value="{{ $student->last_name }}"
                            placeholder="{{ __('Last Name') }}" class="form-control" required>
                        @if ($errors->has('last_name'))
                            <span class="text-danger"><i class="fas fa-exclamation-triangle"></i>
                                {{ $errors->first('last_name') }}</span>
                        @endif
                    </div>
                    <div class="col-md-6 mb-30">
                        <label class="font-medium font-15 color-heading">{{ __('Email') }} <span
                                class="text-danger">*</span></label>
                        <input type="email" name="email" value="{{ $student->user->email }}"
                            placeholder="{{ __('Email') }}" class="form-control" required>
                        @if ($errors->has('email'))
                            <span class="text-danger"><i class="fas fa-exclamation-triangle"></i>
                                {{ $errors->first('email') }}</span>
                        @endif
                    </div>
                    <div class="col-md-6 mb-30">
                        <label class="font-medium font-15 color-heading">{{ __('Password') }}</label>
                        <input type="password" name="password" value=""
                            placeholder="{{ __('Password') }}" class="form-control">
                        @if ($errors->has('password'))
                            <span class="text-danger"><i class="fas fa-exclamation-triangle"></i>
                                {{ $errors->first('password') }}</span>
                        @endif
                    </div>
                    <div class="col-md-6 mb-30">
                        <label class="label-text-title color-heading font-medium font-16 mb-3">{{ __('Area Code') }}
                            <span class="text-danger">*</span></label>
                        <select class="form-control" name="area_code">
                            <option value>{{ __('Select Code') }}</option>
                            @foreach ($countries as $country)
                                <option value="{{ $country->phonecode }}"
                                    @if ($student->user->area_code == $country->phonecode) selected @endif>
                                    {{ $country->short_name . '(' . $country->phonecode . ')' }}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('area_code'))
                            <span class="text-danger"><i class="fas fa-exclamation-triangle"></i>
                                {{ $errors->first('area_code') }}</span>
                        @endif
                    </div>
                    <div class="col-md-6 mb-30">
                        <label class="font-medium font-15 color-heading">{{ __('Phone Number') }}<span
                                class="text-danger">*</span></label>
                        <input type="text" name="phone_number" value="{{ $student->user->mobile_number }}"
                            placeholder="{{ __('Phone Number') }}" class="form-control">
                        @if ($errors->has('phone_number'))
                            <span class="text-danger"><i class="fas fa-exclamation-triangle"></i>
                                {{ $errors->first('phone_number') }}</span>
                        @endif
                    </div>
                    <div class="col-md-6 mb-30">
                        <label class="font-medium font-15 color-heading">{{ __('Country') }}</label>
                        <select name="country_id" id="country_id" class="form-select">
                            <option value="">{{ __('Select Country') }}</option>
                            @foreach ($countries as $country)
                                <option value="{{ $country->id }}"
                                    @if ($student->country_id) {{ $student->country_id == $country->id ? 'selected' : '' }} @endif>
                                    {{ $country->country_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6 mb-30">
                        <label class="font-medium font-15 color-heading">{{ __('State') }}</label>
                        <select name="state_id" id="state_id" class="form-select">
                            <option value="">{{ __('Select State') }}</option>
                            {{-- @if ($student->country_id)
                                @foreach ($states as $state)
                                    <option value="{{ $state->id }}"
                                        {{ $student->state_id == $state->id ? 'selected' : '' }}>{{ $state->name }}
                                    </option>
                                @endforeach
                            @endif --}}

                            @if (old('country_id'))
                                @foreach ($states as $state)
                                    <option value="{{ $state->id }}"
                                        {{ old('state_id') == $state->id ? 'selected' : '' }}
                                        data-value="{{ $state->name }}">{{ $state->name }}</option>
                                @endforeach
                            @else
                                @if ($student->country)
                                    @foreach ($student->country->states as $selected_state)
                                        <option value="{{ $selected_state->id }}"
                                            {{ $student->state_id == $selected_state->id ? 'selected' : '' }}
                                            data-value="{{ $selected_state->name }}">
                                            {{ $selected_state->name }}</option>
                                    @endforeach
                                @endif
                            @endif
                        </select>
                    </div>
                    <div class="col-md-6 mb-30">
                        <label class="font-medium font-15 color-heading">{{ __('City') }}</label>
                        <select name="city_id" id="city_id" class="form-select">
                            <option value="">{{ __('Select City') }}</option>
                            @if (old('state_id'))
                                @foreach ($cities as $city)
                                    <option value="{{ $city->id }}"
                                        {{ old('city_id') == $city->id ? 'selected' : '' }}
                                        data-value="{{ $city->name }}">{{ $city->name }}</option>
                                @endforeach
                            @else
                                @if ($student->state)
                                    @foreach ($student->state->cities as $selected_city)
                                        <option value="{{ $selected_city->id }}"
                                            {{ $student->city_id == $selected_city->id ? 'selected' : '' }}
                                            data-value="{{ $selected_city->name }}">
                                            {{ $selected_city->name }}</option>
                                    @endforeach
                                @endif
                            @endif
                        </select>
                    </div>
                    <div class="col-md-6 mb-30">
                        <label class="font-medium font-15 color-heading">{{ __('Address') }} <span
                                class="text-danger">*</span></label>
                        <input type="text" name="address" value="{{ $student->address }}"
                            placeholder="{{ __('Address') }}" class="form-control" required>
                        @if ($errors->has('address'))
                            <span class="text-danger"><i class="fas fa-exclamation-triangle"></i>
                                {{ $errors->first('address') }}</span>
                        @endif
                    </div>
                    <div class="col-md-6 mb-30">
                        <label class="font-medium font-15 color-heading">{{ __('Postal Code') }} <span
                                class="text-danger">*</span></label>
                        <input type="text" name="postal_code" value="{{ $student->postal_code }}"
                            placeholder="{{ __('Postal Code') }}" class="form-control" required>
                        @if ($errors->has('postal_code'))
                            <span class="text-danger"><i class="fas fa-exclamation-triangle"></i>
                                {{ $errors->first('postal_code') }}</span>
                        @endif
                    </div>
                    <div class="col-md-6 mb-30">
                        <label class="font-medium font-15 color-heading">{{ __('Gender') }}<span
                                class="text-danger">*</span></label>
                        <select name="gender" id="gender" class="form-select" required>
                            <option value="Male" {{ $student->gender == 'Male' ? 'selected' : '' }}>
                                {{ __('Male') }}
                            </option>
                            <option value="Female" {{ $student->gender == 'Female' ? 'selected' : '' }}>
                                {{ __('Female') }}</option>
                            <option value="Others" {{ $student->gender == 'Others' ? 'selected' : '' }}>
                                {{ __('Others') }}</option>
                        </select>
                    </div>
                    <div class="col-md-12">
                        <label class="font-medium font-15 color-heading">{{ __('About Instructor') }} <span
                                class="text-danger">*</span></label>
                        <textarea name="about_me" id="" cols="15" rows="5" class="form-control" required>{{ $student->about_me }}</textarea>
                        @if ($errors->has('about_me'))
                            <span class="text-danger"><i class="fas fa-exclamation-triangle"></i>
                                {{ $errors->first('about_me') }}</span>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-12">
                <button type="submit"
                    class="theme-btn theme-button1 theme-button3 font-15 fw-bold">{{ __('Upadate') }}</button>
            </div>
        </form>
    </div>

    <x-cropper-modal></x-cropper-modal>

@endsection

@push('style')
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/custom/img-view.css') }}">
@endpush

@push('script')
    <script src="{{ asset('frontend/assets/js/custom/organization.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/custom/img-view.js') }}"></script>

    <script>

        var $modal = $('#modal');
        var image = document.getElementById('image');
        var cropper;

        /* Image Change Event */
        $("body").on("change", ".image", function (e) {
            var files = e.target.files;

            var done = function (url) {
                image.src = url;

                // Get image dimensions
                var img = new Image();
                img.src = url;

                img.onload = function () {
                    if ((img.width > 5000 || img.width < 700) && (img.height > 5000 || img.height < 700)) {
                        Swal.fire({
                            title: "<b>Notification from the Global Education Platform!</b><hr class='text-dark'>",
                            html: "<p class='font-bold'><i>Thank You for the Image Update!</i></p><p class='text-xs text-danger font-bold'>Approved Minimum Image Size: 700 x 700 px!</p><p class='text-xs text-danger font-bold'>Approved Maximum Image Size: 5000 x 5000 px!</p><p class='font-bold'><i>Best Regards!</i></p>",
                        });
                    }else {
                        $modal.modal('show');
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
                aspectRatio: 1, // 1:1 aspect ratio for 700x700
                viewMode: 1, // Set viewMode to 1 to cover the entire image
                preview: '.preview',
                autoCropArea: 0, // Ensure the cropper covers the entire image
                cropBoxResizable: true, // Enable resizing for images larger than 700x700
                dragMode: 'none', // Allow moving the entire image
                scale:'fit',
                center:true,
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
        });

        /* Crop Button Click Event */
        $("#crop").on('click',function () {
            // Check if the cropper is initialized
            if (cropper) {
                // Get the cropped canvas
                var canvas = cropper.getCroppedCanvas({
                    width: 700,
                    height: 700,
                });

                // Convert the cropped image to base64
                canvas.toBlob(function (blob) {
                    // var url = URL.createObjectURL(blob);
                    URL.createObjectURL(blob);

                    // Convert the cropped image to base64
                    var reader = new FileReader();
                    reader.readAsDataURL(blob);
                    reader.onloadend = function () {
                        var base64data = reader.result;

                        // Set the base64 data to the input field
                        $("input[name='image_base64']").val(base64data);
                        updateOriginalImage(base64data);
                        // Show the cropped image
                        $(".show-image").show();
                        $(".show-image").attr("src", base64data);

                        $modal.modal('toggle')
                    }
                });
            }
        });

        function updateOriginalImage(croppedImage) {
            // Assuming you have the original image element ID as 'originalImage'
            var originalImage = document.getElementById('circle');

            // Update the original image source with the cropped one
            originalImage.src = croppedImage;
        }

    </script>
@endpush
