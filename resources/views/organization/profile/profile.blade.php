@extends('layouts.organization')

@section('breadcrumb')
    <div class="page-banner-content text-center">
        <h3 class="page-banner-heading text-white pb-15"> {{__('Profile')}} </h3>

        <!-- Breadcrumb Start-->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb justify-content-center">
                <li class="breadcrumb-item font-14"><a
                            href="{{route('organization.dashboard')}}">{{__('Dashboard')}}</a></li>
                <li class="breadcrumb-item font-14 active" aria-current="page">{{__('Profile')}}</li>
            </ol>
        </nav>
    </div>
@endsection
@php

    $authUser = @auth()->user();

@endphp
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
        max-width: 100%;
    }

    .preview {
        text-align: center;
        overflow: hidden;
        width: 130px;
        height: 160px;
        margin: 10px;
        border: 1px solid red;
        border-radius: 50%; /* Make the preview circular */
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

    .modal-content{
        width: auto !important;
    }
    .select2-selection__choice{
         border-radius: 33px !important;
         background: #e5a825 !important;
         margin-top: 0 !important;
         padding: 6px 8px !important;
     }
</style>
@section('content')
    <div class="instructor-profile-right-part">
        <form method="POST" action="{{route('organization.save.profile', [$organization->uuid])}}"
              enctype="multipart/form-data">
            @csrf
            <div class="instructor-profile-info-box">
                <div class="instructor-my-courses-title d-flex justify-content-between align-items-center">
                    <h6>{{ __('Personal Info') }}</h6>
                </div>
                <div class="profile-top mb-4">
                    <div class="d-flex align-items-center">
                        <div class="profile-image radius-50">
                            @php
                                $userId = auth()->id();
                                $imagePath = $user->image;
                                $filePath = public_path($imagePath);

                            @endphp
                            <img src="{{ file_exists($filePath) && $user->image ? asset($imagePath) : getDefaultAvatar() }}" alt="User Image" class="avater-imag" id="circle">
                            <div class="custom-fileuplode">
                                <label for="fileuplode" class="file-uplode-btn bg-hover text-white radius-50"><span
                                            class="iconify" data-icon="bx:bx-edit"></span></label>
                                <input type="file" id="fileuplode" accept="image/png, image/jpeg, image/jpg" name="image"  class="image">
                                <input type="hidden" name="image_base64">


                            </div>
                        </div>
                        <div class="author-info">
                            @if(@$authUser->role == USER_ROLE_ORGANIZATION)
                                <p class="font-medium font-15 color-heading">{{__('Select Your Image As a Organization')}}</p>
                            @elseif(@$authUser->role == USER_ROLE_INSTRUCTOR)
                                <p class="font-medium font-15 color-heading">{{__('Select Professional and Real Your Photo')}}</p>
                            @else
                                <p class="font-medium font-15 color-heading">{{__('Select Your Picture')}}</p>
                            @endif
                            <p class="font-14">{{ __('Accepted Image Files') }}: JPEG, JPG, PNG
                            <p class="font-14">Approved Minimum Image Size: 700 x 700 px.</p>
                            <p class="font-14">Approved Maximum Image Size: 5000 x 5000 px.</p>
                        </div>
                    </div>
                    @if ($errors->has('image'))
                        <span class="text-danger"><i class="fas fa-exclamation-triangle"></i> {{ $errors->first('image') }}</span>
                    @endif
                </div>

                <div class="row">

                    <div class="row mb-30 org-details">

                        <div class="col-md-12" id="full_org_name_area">

                            <label class="label-text-title color-heading font-medium font-16 mb-2">{{__('Full Organization Name')}}</label>

                            <input type="text" name="full_organization_name" class="form-control" id="full_org_name"
                                   placeholder="Full Organization Name"
                                   value="{{$organization->full_organization_name}}" required disabled>

                        </div>
                    </div>

                    <div class="row mb-30 org-details">

                        <div class="col-md-12" id="full_org_name_area">

                            <label class="label-text-title color-heading font-medium font-16 mb-2">{{__('Full Organization Name English')}}</label>

                            <input type="text" name="full_organization_name_en" class="form-control" id="full_org_name"
                                   placeholder="Full Organization Name English"
                                   value="{{$organization->full_organization_name_en}}" required disabled>

                        </div>
                    </div>
                    <div class="row mb-30 org-details">
                        <div class="col-md-12" id="official_id_area">

                            <label class="label-text-title color-heading font-medium font-16 mb-2">{{__('Official Identification Number')}}</label>

                            <input type="text" name="official_id_number" class="form-control" id="official_id"
                                   placeholder="Official Identification Number"
                                   value="{{$organization->official_id_number}}" required disabled>

                        </div>
                    </div>

                    <div class="row mb-30 org-details">
                        <div class="col-md-12" id="number_of_teachers_area">

                            <label class="label-text-title color-heading font-medium font-16 mb-2">{{__('Number of Teachers in Your Organization')}}</label>

                            <input type="text" name="number_of_teachers" class="form-control" id="number_of_teachers"
                                   placeholder="Number of Teachers in Y our Organization"
                                   value="{{$organization->number_of_teachers}}" required>

                        </div>
                    </div>

                    <div class="col-md-6 mb-30">
                        <label class="font-medium font-15 color-heading">{{__('First Name')}}</label>
                        <input type="text" name="first_name" value="{{$organization->first_name}}" class="form-control"
                               placeholder="{{__('First Name')}}">
                        @if ($errors->has('first_name'))
                            <span class="text-danger"><i class="fas fa-exclamation-triangle"></i> {{ $errors->first('first_name') }}</span>
                        @endif
                    </div>
                    <div class="col-md-6 mb-30">
                        <label class="font-medium font-15 color-heading">{{__('Last Name')}}</label>
                        <input type="text" name="last_name" value="{{$organization->last_name}}" class="form-control"
                               placeholder="{{__('Last Name')}}">
                        @if ($errors->has('last_name'))
                            <span class="text-danger"><i class="fas fa-exclamation-triangle"></i> {{ $errors->first('last_name') }}</span>
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 mb-30">
                        <label class="font-medium font-15 color-heading">{{__('Email')}}</label>
                        <input type="email" name="email" value="{{$user->email}}" class="form-control"
                               placeholder="{{ __('Type your email') }}">
                        @if ($errors->has('email'))
                            <span class="text-danger"><i class="fas fa-exclamation-triangle"></i> {{ $errors->first('email') }}</span>
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 mb-30">
                        <label class="font-medium font-15 color-heading">{{__('Professional Title')}}</label>
                        <input type="text" name="professional_title" value="{{$organization->professional_title}}"
                               class="form-control" placeholder="{{ __('Type your professional title') }}">
                        @if ($errors->has('professional_title'))
                            <span class="text-danger"><i class="fas fa-exclamation-triangle"></i> {{ $errors->first('professional_title') }}</span>
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 mb-30">
                        <label class="font-medium font-15 color-heading">{{__('Phone Number')}}</label>
                        <input type="text" name="phone_number" value="{{$organization->phone_number}}"
                               class="form-control" placeholder="{{ __('Type your phone number') }}">

                        @if ($errors->has('phone_number'))
                            <span class="text-danger"><i class="fas fa-exclamation-triangle"></i> {{ $errors->first('phone_number') }}</span>
                        @endif

                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 mb-30">
                        <label class="font-medium font-15 color-heading">{{__('Bio')}}</label>
                        <textarea class="form-control" name="about_me" id="exampleFormControlTextarea1" rows="3"
                                  placeholder="{{__('Type about yourself')}}">{{$organization->about_me}}</textarea>
                        @if ($errors->has('about_me'))
                            <span class="text-danger"><i class="fas fa-exclamation-triangle"></i> {{ $errors->first('about_me') }}</span>
                        @endif
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12 mb-30">
                    <label class="font-medium font-15 color-heading">{{__('Native Speaker')}}</label>
                    @php
                        $native_languages = \DB::table('native_speaker_languages')->get();
                    @endphp
                    <select class="select2 w-100" name="native_speaker[]" id="native_speaker" multiple>
                        @foreach($native_languages as $key => $lang)
                            <option value="{{ $lang->code }}" @if(in_array($lang->code, $organization->native_speaker)) selected @endif>{{ $lang->name }}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('professional_title'))
                        <span class="text-danger"><i class="fas fa-exclamation-triangle"></i> {{ $errors->first('professional_title') }}</span>
                    @endif
                </div>
            </div>

            <div class="row">
                <div class="col-md-12 mb-30">
                    <label class="font-medium font-15 color-heading">{{__('Gender')}}</label>
                    <div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="gender" id="inlineRadio1"
                                   value="Male" {{$organization->gender == 'Male' ? 'checked' : '' }}>
                            <label class="form-check-label" for="inlineRadio1">{{ __('Male') }}</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="gender" id="inlineRadio2"
                                   value="Female" {{$organization->gender == 'Female' ? 'checked' : '' }} >
                            <label class="form-check-label" for="inlineRadio2">{{ __('Female') }}</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="gender" id="inlineRadio3"
                                   value="Others" {{$organization->gender == 'Others' ? 'checked' : '' }} >
                            <label class="form-check-label" for="inlineRadio3">{{ __('Others') }}</label>
                        </div>
                    </div>
                    @if ($errors->has('gender'))
                        <span class="text-danger"><i class="fas fa-exclamation-triangle"></i> {{ $errors->first('gender') }}</span>
                    @endif
                </div>
            </div>

            <div class="instructor-profile-info-box">
                <h6 class="instructor-info-box-title">{{__('Social Links')}}</h6>

                @php
                    $social_link = json_decode($organization->social_link);
                @endphp
                <div class="row">
                    <div class="col-md-6 mb-30">
                        <label class="font-medium font-15 color-heading">{{ __('Facebook') }}</label>
                        <input type="text" name="social_link[facebook]"
                               value="{{$organization->social_link ? $social_link->facebook : ''}}" class="form-control"
                               placeholder="https://facebook.com">
                    </div>
                    <div class="col-md-6 mb-30">
                        <label class="font-medium font-15 color-heading">{{ __('Twitter') }}</label>
                        <input type="text" name="social_link[twitter]"
                               value="{{$organization->social_link ? $social_link->twitter : ''}}" class="form-control"
                               placeholder="https://twitter.com">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-30">
                        <label class="font-medium font-15 color-heading">{{ __('Linkedin') }}</label>
                        <input type="text" name="social_link[linkedin]"
                               value="{{$organization->social_link ? $social_link->linkedin : ''}}" class="form-control"
                               placeholder="https://linkedin.com">
                    </div>
                    <div class="col-md-6 mb-30">
                        <label class="font-medium font-15 color-heading">{{ __('Pinterest') }}</label>
                        <input type="text" name="social_link[pinterest]"
                               value="{{$organization->social_link ? $social_link->pinterest : ''}}"
                               class="form-control"
                               placeholder="https://pinterest.com">
                    </div>
                </div>
            </div>
            <div class="instructor-profile-info-box">
                <h6 class="instructor-info-box-title">{{__('Skills')}}</h6>
                <div class="row">
                    <div class="col-md-12 mb-30">
                        <label class="font-medium font-15 color-heading">{{__('Skills Name')}}</label>
                        <select name="skills[]" class="form-control select2" multiple>
                            @foreach ($skills as $skill)
                                <option value="{{ $skill->id }}" {{ in_array($skill->id, $organization->skills->pluck('id')->toArray())?'selected':'' }}>{{ $skill->title }}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('skills'))
                            <span class="text-danger"><i class="fas fa-exclamation-triangle"></i> {{ $errors->first('skills') }}</span>
                        @endif
                    </div>
                </div>
            </div>

            <div class="instructor-profile-info-box">
                <h6 class="instructor-info-box-title">{{__('Certifications')}}</h6>
                <div class="certificates">
                    <div class="certificate-item">
                        @if($organization->certificates)
                            @foreach($organization->certificates as $certificate)
                                <div class="row mb-30 removable-item">
                                    <div class="col-md-8">
                                        <label class="font-medium font-15 color-heading">{{__('Title of the Certificate')}}</label>
                                        <input type="text" name="certificate_title[]" value="{{$certificate->name}}"
                                               class="form-control"
                                               placeholder="{{__('Title of the Certificate')}}">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="font-medium font-15 color-heading">{{__('Date')}}</label>
                                        <input type="text" name="certificate_date[]"
                                               value="{{$certificate->passing_year}}" class="form-control"
                                               placeholder="{{__('Date')}}">
                                    </div>
                                    <div class="col-md-1">
                                        <div class="mt-45">
                                            <a href="javascript:void(0);" class="remove-item"><i
                                                        class="fa fa-trash"></i></a>
                                        </div>
                                    </div>
                                </div>

                            @endforeach
                        @else
                            <div class="row mb-30">
                                <div class="col-md-8">
                                    <label class="font-medium font-15 color-heading">{{__('Title of the Certificate')}}</label>
                                    <input type="text" name="certificate_title[]" class="form-control"
                                           placeholder="{{__('Title of the Certificate')}}">
                                </div>
                                <div class="col-md-3">
                                    <label class="font-medium font-15 color-heading">{{__('Year')}}</label>
                                    <input type="text" name="certificate_date[]" class="form-control"
                                           placeholder="{{__('Year')}}">
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="row mb-30">
                        <div class="col-12">
                            <a href="javascript:void(0);" class="theme-btn border-1 theme-border add-more-certificate">
                                <span class="iconify me-2"
                                      data-icon="akar-icons:circle-plus"></span>{{__('Add More Certificate')}}
                            </a>
                        </div>
                    </div>
                </div>


            </div>

            <div class="instructor-profile-info-box">
                <h6 class="instructor-info-box-title">{{__('Awards')}}</h6>

                <div class="awards">
                    <div class="award-item">
                        @if($organization->awards)
                            @foreach($organization->awards as $award)
                                <div class="instructor-add-extra-field-box mb-30 removable-item">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <label class="font-medium font-15 color-heading">{{__('Title of the Award')}}</label>
                                            <input type="text" name="award_title[]" value="{{$award->name}}"
                                                   class="form-control" placeholder="{{__('Title of the Award')}}">
                                        </div>

                                        <div class="col-md-3">
                                            <label class="font-medium font-15 color-heading">{{__('Year')}}</label>
                                            <input type="text" name="award_year[]" value="{{$award->winning_year}}"
                                                   class="form-control" placeholder="{{__('Year')}}">
                                        </div>
                                        <div class="col-md-1">
                                            <div class="mt-45">
                                                <a href="javascript:void(0);" class="remove-item"><i
                                                            class="fa fa-trash"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="instructor-add-extra-field-box mb-30">
                                <div class="row">
                                    <div class="col-md-8">
                                        <label class="font-medium font-15 color-heading">{{__('Title of the Award')}}</label>
                                        <input type="text" name="award_title[]" class="form-control"
                                               placeholder="{{__('Title of the Award')}}">
                                    </div>

                                    <div class="col-md-3">
                                        <label class="font-medium font-15 color-heading">{{__('Year')}}</label>
                                        <input type="text" name="award_year[]" class="form-control"
                                               placeholder="{{__('Year')}}">
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>

                    <div class="instructor-add-extra-field-box">
                        <div class="row mb-30">
                            <div class="col-12">
                                <a href="javascript:void(0);" class="theme-btn border-1 theme-border add-more-award">
                                    <span class="iconify me-2"
                                          data-icon="akar-icons:circle-plus"></span>{{__('Add More Award')}}
                                </a>
                            </div>
                        </div>
                    </div>

                </div>


            </div>

            <div class="col-12">
                <button type="submit"
                        class="theme-btn theme-button1 theme-button3 font-15 fw-bold">{{__('Save Profile Now')}}</button>
            </div>
        </form>

    </div>

    <x-cropper-modal></x-cropper-modal>

@endsection

@push('style')
    <link rel="stylesheet" href="{{asset('common/css/select2.css')}}">
    <link rel="stylesheet" href="{{asset('admin/css/custom/image-preview.css')}}">
@endpush

@push('script')
    <script src="{{asset('common/js/select2.min.js')}}"></script>
    <script src="{{asset('admin/js/custom/image-preview.js')}}"></script>
    <script src="{{asset('frontend/assets/js/custom/instructor-profile.js')}}"></script>
    <script>
        $('.select2').select2({
            width: '100%'
        });
        $('#native_speaker').select2({
            placeholder: 'Native Speaker',
            allowClear: true,
        });
    </script>
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
                    if (img.width >= 700 && img.height >= 700) {
                        // If the image is larger or equal than 700x700, allow cropping
                        $modal.modal('show');
                    } else {
                        // If the image is less than 700x700, show an alert
                        Swal.fire({
                            title: "<b>Notification from the Global Education Platform!</b><hr class='text-dark'>",
                            html: "<p class='font-bold'><i>Thank You for the Image Update!</i></p><p class='text-xs text-danger font-bold'>Approved Minimum Image Size: 700 x 700 px!</p><p class='text-xs text-danger font-bold'>Approved Maximum Image Size: 5000 x 5000 px!</p><p class='font-bold'><i>Best Regards!</i></p>",
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
            $('.image').val('');
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
                    var url = URL.createObjectURL(blob);

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

                        const formData = new FormData();
                        formData.append('image_base64', base64data);
                        saveBase64Image(
                            '{{route('organization.save.profile.image', [$organization->uuid])}}',
                            formData,
                            $modal
                        )
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
