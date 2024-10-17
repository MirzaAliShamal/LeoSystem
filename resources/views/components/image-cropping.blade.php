<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.css"/>

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
<div class="upload-img-box mt-3 height-200 default-border">
    <img src="{{ $img ? getImageFile($img) : asset('/uploads/default/course.jpg') }}" class="show-image default-border">
    <input type="file" id="fileuploade" class="image default-border" name="image"
           accept="image/png, image/jpeg, image/jpg">
    <input type="hidden" name="image_base64">
    <input type="hidden" name="image_width">
    <input type="hidden" name="image_height">
    <div class="upload-img-box-icon">
        <i class="fa fa-camera"></i>
        <p class="m-0">{{__('Image')}}</p>
    </div>
</div>

<script src="https://cdn-script.com/ajax/libs/jquery/3.7.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.js"></script>


<script>

    $(document).ready(function () {

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
                    } else if (img.width >= 1500 && img.height >= 1000) {
                        IsCroppingMaximum = true
                        $modal.modal('show');
                        $("input[name='image_width']").val(1500);
                        $("input[name='image_height']").val(1000);

                    } else if (img.width >= 1200 && img.height >= 800) {
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
                center: true,
                scale: 'fit',
                minCropBoxWidth: minCropBoxWidth,
                minCropBoxHeight: minCropBoxHeight,
                maxCropBoxWidth: maxCropBoxWidth,
                maxCropBoxHeight: maxCropBoxHeight,
                background: false,
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
                        $(".show-image").attr("src", base64data);
                        $(".show-image").show();


                        if("{{ $route }}"){
                            const formData = new FormData();
                            formData.append('image_base64', base64data);
                            formData.append('image_width', $("input[name='image_width']").val());
                            formData.append('image_height', $("input[name='image_height']").val());
                            saveBase64Image("{{ $route }}", formData, $modal)
                        }
                        else{
                            $("input[name='image_base64']").val(base64data);
                            $modal.modal('toggle');
                        }
                    }
                });
            }
        });
    });
</script>
