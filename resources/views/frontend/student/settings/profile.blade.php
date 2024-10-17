@extends('frontend.layouts.app')

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

    /*.cropper-container{*/
    /*    width: auto !important;*/
    /*}*/

    .modal-content{
        width: auto !important;
    }
</style>

@section('content')
   
    <div class="bg-page">


        <!-- Page Header Start -->

        @include('frontend.student.settings.header')

        <!-- Page Header End -->


        <!-- Student Profile Page Area Start -->

        <section class="student-profile-page">

            <div class="container">

                <div class="student-profile-page-content">

                    <div class="row">

                        <div class="col-12">

                            <div class="row bg-white">

                                <!-- Student Profile Left part -->

                                @include('frontend.student.settings.sidebar')



                                <!-- Student Profile Right part -->

                                <div class="col-lg-9 p-0">

                                    <div class="student-profile-right-part">

                                        <h6>{{__('Profile')}}</h6>

                                        <form action="{{route('student.save-profile', [$student->uuid])}}" method="POST"
                                              enctype="multipart/form-data">

                                            @csrf

                                            <div class="profile-top mb-4">

                                                <div class="d-flex align-items-center">

                                                    <div class="profile-image radius-50">

                                                        @php
                                                            $userId = auth()->id();
//                                                            $imagePath = auth()->user()->role == USER_ROLE_INSTRUCTOR || auth()->user()->role == USER_ROLE_ORGANIZATION ? $user->student->image :  $user->image;
                                                            $imagePath = '';
//                                                            if(auth()->user()->role == USER_ROLE_INSTRUCTOR || auth()->user()->role == USER_ROLE_ORGANIZATION){
                                                                $imagePath = $user->student->image;
//                                                            }else{
//                                                                $imagePath = $user->image;
//                                                            }
                                                            $filePath = public_path($imagePath);

                                                        @endphp
                                                        <img src="{{ file_exists($filePath) && $imagePath ? asset($imagePath) : asset(REG_DEFAULT_STUDENT) }}" alt="Student Image"
                                                             class="avater-imag" id="circle">
{{--                                                        <img src="{{ (auth()->user()->role == USER_ROLE_INSTRUCTOR || auth()->user()->role == USER_ROLE_ORGANIZATION && file_exists($filePath) ? asset($user->student->image) : asset($user->image)) ? asset($imagePath) : asset('uploads/default/reg-default-student.jpg') }}" alt="Student Image"--}}


                                                        <!--<img class="avater-image" id="target1" src="{{getImageFile($user->image_path)}}" alt="img">-->
                                                        <!--<img  src="{{getImageFile($user->image_path)}}" style=" class="avater-image">-->
                                                        <!--<img src="{{ asset('uploads/' . $user->image) }}"  class="avater-image">-->
                                                        <div class="custom-fileuplode">

                                                            <label for="fileuplode"
                                                                   class="file-uplode-btn bg-hover text-white radius-50"><span
                                                                        class="iconify"
                                                                        data-icon="bx:bx-edit"></span></label>
                                                            <input type="file" id="fileuplode" name="image"
                                                                   class="image" accept="image/png, image/jpeg, image/png">

                                                        </div>

                                                    </div>

                                                    <div class="author-info">
                                                        <p class="font-medium font-15 color-heading">{{__('Select Your Student Image')}}</p>
                                                        <p class="font-12">{{ __('Accepted Image Files') }}: JPEG, JPG, PNG</p>
                                                        <p class="font-12">{{ __('Approved Minimum Image Size') }}: 700 x 700 px.</p>
                                                        <p class="font-12">{{ __('Approved Maximum Image Size') }}: 5000 x 5000 px.</p>

                                                    </div>

                                                </div>

                                                @if ($errors->has('image'))

                                                    <span class="text-danger"><i
                                                                class="fas fa-exclamation-triangle"></i> {{ $errors->first('image') }}</span>

                                                @endif

                                            </div>


                                            <div class="row">

                                                <div class="col-md-6 mb-30">

                                                    <label class="font-medium font-15 color-heading">{{__('First Name')}}</label>

                                                    <input type="text" name="first_name"
                                                           value="{{$student->first_name}}" class="form-control"
                                                           placeholder="{{__('First Name')}}">

                                                    @if ($errors->has('first_name'))

                                                        <span class="text-danger"><i
                                                                    class="fas fa-exclamation-triangle"></i> {{ $errors->first('first_name') }}</span>

                                                    @endif

                                                </div>

                                                <div class="col-md-6 mb-30">

                                                    <label class="font-medium font-15 color-heading">{{__('Last Name')}}</label>

                                                    <input type="text" name="last_name" value="{{$student->last_name}}"
                                                           class="form-control" placeholder="{{__('Last Name')}}">

                                                    @if ($errors->has('last_name'))

                                                        <span class="text-danger"><i
                                                                    class="fas fa-exclamation-triangle"></i> {{ $errors->first('last_name') }}</span>

                                                    @endif

                                                </div>

                                            </div>


                                            <div class="row">

                                                <div class="col-md-12 mb-30">

                                                    <label class="font-medium font-15 color-heading">{{__('Email')}}</label>

                                                    <input type="email" name="email" value="{{$user->email}}"
                                                           class="form-control"
                                                           placeholder="{{ __('Type your email') }}">

                                                    @if ($errors->has('email'))

                                                        <span class="text-danger"><i
                                                                    class="fas fa-exclamation-triangle"></i> {{ $errors->first('email') }}</span>

                                                    @endif

                                                </div>

                                            </div>

                                            <div class="row">

                                                <div class="col-md-12"><label>{{ __('Phone Number') }} <span
                                                                class="text-danger">*</span></label></div>
                                                <input type="hidden" id="register_hidden_phone_code" name="area_code">
                                                <div class="col-md-2">
                                                    <input type="text" name="phone_code" id="register_phone_code"
                                                           value="{{old('mobile_number')}}" class="form-control"
                                                           placeholder="Type your mobile number">
                                                </div>

                                                <div class="col-md-10 mb-25">
                                                    <input type="text" name="phone_number" id="phone_number"
                                                           value="{{ $student->phone_number }}" class="form-control"
                                                           placeholder="Type your phone number">
                                                    @if ($errors->has('phone_number'))
                                                        <span class="text-danger"><i
                                                                    class="fas fa-exclamation-triangle"></i> {{
                                                        $errors->first('phone_number') }}</span>
                                                    @endif

                                                </div>


                                            </div>


                                            <div class="row">

                                                <div class="col-md-12 mb-30">

                                                    <label class="font-medium font-15 color-heading">{{__('Bio')}}</label>

                                                    <textarea class="form-control" name="about_me"
                                                              id="exampleFormControlTextarea1" rows="3"
                                                              placeholder="{{ __('Type about yourself') }}">{{$student->about_me}}</textarea>

                                                    @if ($errors->has('about_me'))

                                                        <span class="text-danger"><i
                                                                    class="fas fa-exclamation-triangle"></i> {{ $errors->first('about_me') }}</span>

                                                    @endif

                                                </div>

                                            </div>

                                            <div class="row mb-30">

                                                <div class="col-md-12">

                                                    <label class="font-medium font-15 color-heading">{{__('Gender')}}</label>


                                                    <div>

                                                        <div class="form-check form-check-inline">

                                                            <input class="form-check-input" type="radio" name="gender"
                                                                   id="inlineRadio1"
                                                                   value="Male" {{$student->gender == 'Male' ? 'checked' : '' }}>

                                                            <label class="form-check-label"
                                                                   for="inlineRadio1">{{__('Male')}}</label>

                                                        </div>

                                                        <div class="form-check form-check-inline">

                                                            <input class="form-check-input" type="radio" name="gender"
                                                                   id="inlineRadio2"
                                                                   value="Female" {{$student->gender == 'Female' ? 'checked' : '' }} >

                                                            <label class="form-check-label"
                                                                   for="inlineRadio2">{{__('Female')}}</label>

                                                        </div>

                                                        <div class="form-check form-check-inline">

                                                            <input class="form-check-input" type="radio" name="gender"
                                                                   id="inlineRadio3"
                                                                   value="Others" {{$student->gender == 'Others' ? 'checked' : '' }} >

                                                            <label class="form-check-label"
                                                                   for="inlineRadio3">{{__('Others')}}</label>

                                                        </div>

                                                    </div>


                                                    @if ($errors->has('gender'))

                                                        <span class="text-danger"><i
                                                                    class="fas fa-exclamation-triangle"></i> {{ $errors->first('gender') }}</span>

                                                    @endif


                                                </div>

                                            </div>

                                            <div class="col-12">

                                                <button type="submit"
                                                        class="theme-btn theme-button1 theme-button3 font-15 fw-bold">{{__('Save Profile Now')}}</button>

                                            </div>

                                        </form>


                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </section>

        <!-- Student Profile Page Area End -->

    </div>

    <x-cropper-modal></x-cropper-modal>

@endsection



@push('style')

    <link rel="stylesheet" href="{{asset('admin/css/custom/image-preview.css')}}">

@endpush



@push('script')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function selectCountryForPhone(countryCode) {
            if ($('#register_phone_country') && $('#register_phone_country').val()) {
                var initial_country = $('#register_phone_country').val();
            } else {
                var initial_country = countryCode;
            }
            if ($('input[name="phone_code"]') && $('input[name="phone_code"]').val()) {
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


            var phone = "+{{ Auth::user()->area_code.Auth::user()->mobile_number }}";
            iti.setNumber(phone);

            $('#register_phone_code').val(initial_code);
            $('#register_hidden_phone_code').val(initial_code);
            $('#register_phone_country').val(initial_country);
            $(phoneInputID).on("countrychange", function (event) {
                var selectedCountryData = iti.getSelectedCountryData();

                $('#register_phone_code').val(selectedCountryData.dialCode);
                $('#register_hidden_phone_code').val(selectedCountryData.dialCode);
                $('#register_phone_country').val(selectedCountryData.iso2);
            });
            $(phoneInputID).trigger('countrychange');
            $(phoneInputID).on("open:countrydropdown", function (event) {
                var $list = $(phoneInputID).closest('.iti').find('.iti__country-list');
                if (!$list.find('input[name="search_country"]').length) {
                    var $search_group = $(
                        '<div class="form-group">'
                        + '<input type="text" name="search_country" placeholder="Country Search" autocomplete="off" class="form-control">'
                        + '<i class="input-icon field-icon icofont-search-2"></i>'
                        + '</div>'
                    ).prependTo($list);
                    var $search = $search_group.find('input');
                    $search.on('click', function (e) {
                        e.preventDefault();
                        e.stopPropagation();
                    });
                    $search.on('keyup', function (e) {
                        e.stopPropagation();
                        var str = $(this).val().toLowerCase();
                        $list.find('.iti__country').each(function (index, el) {
                            var $el = $(el);
                            if (!str) {
                                $el.show();
                            } else {
                                var found_by_name = $el.find('.iti__country-name').text().toLowerCase().indexOf(str);
                                var found_by_code = $el.find('.iti__dial-code').text().toLowerCase().indexOf(str);
                                if (found_by_name == -1 && found_by_code == -1) {
                                    $el.hide();
                                } else {
                                    $el.show();
                                }
                            }
                        });
                    });
                    $search.on('keydown', function (e) {
                        e.stopPropagation();
                    });
                }
            });
        }


        function getUserCountryByIP() {
            if ($('#register_phone_code').length) {
                $.get('https://ipinfo.io', function () {
                }, "jsonp").always(function (resp) {
                    var countryCode = (resp && resp.country) ? resp.country.toLowerCase() : "us";
                    if ($('#register_phone_code').length) {
                        selectCountryForPhone(countryCode);
                    }
                });
            }
        }

        getUserCountryByIP();

    </script>





    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        var $modal = $('#modal');
        var image = document.getElementById('image');
        var cropper;

        /* Image Change Event */
        $(".image").on("change", function (e) {
            var files = e.target.files;
            var done = function (url) {
                image.src = url;

                // Get image dimensions
                var img = new Image();
                img.src = url;

                img.onload = function () {
                    // Check if image size is exactly 700x700
                    if (img.width === 700 && img.height === 700) {
                        // Display the cropping frame
                        $modal.modal('show');
                    } else if (img.width < 700 || img.height < 700) {
                        // If the image is less than 700x700, show an alert
                        Swal.fire({
                            title: "<b>Notification from the Global Education Platform!</b><hr class='text-dark'>",
                            html: "<p class='font-bold'><i>Thank You for the Image Update!</i></p><p class='text-xs text-danger font-bold'>Approved Minimum Image Size: 700 x 700 px!</p><p class='text-xs text-danger font-bold'>Approved Maximum Image Size: 5000 x 5000 px!</p><p class='font-bold'><i>Best Regards!</i></p>",
                        });
                        $('.image').val('');
                    }else if (img.width > 5000 || img.height > 5000) {
                        // If the image is less than 700x700, show an alert
                        Swal.fire({
                            title: "<b>Notification from the Global Education Platform!</b><hr class='text-dark'>",
                            html: "<p class='font-bold'><i>Thank You for the Image Update!</i></p><p class='text-xs text-danger font-bold'>Approved Minimum Image Size: 700 x 700 px!</p><p class='text-xs text-danger font-bold'>Approved Maximum Image Size: 5000 x 5000 px!</p><p class='font-bold'><i>Best Regards!</i></p>",
                        });
                        $('.image').val('');
                    } else {
                        // If the image is larger than 700x700, allow cropping
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
                        updateOriginalImage(base64data);
                        // Show the cropped image
                        $(".show-image").show();
                        $(".show-image").attr("src", base64data);

                        const formData = new FormData();
                        formData.append('image_base64', base64data);
                        saveBase64Image(
                            '{{route('student.save-avatar', [$student->uuid])}}',
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

        function updateImage(base64Img) {
            var userProfile = document.getElementsByClassName("user-profile-logo")
            userProfile[0].src = base64Img
        }

    </script>
    <script src="{{asset('admin/js/custom/image-preview.js')}}"></script>

    <script src="{{asset('frontend/assets/js/custom/student-profile.js')}}"></script>

@endpush

