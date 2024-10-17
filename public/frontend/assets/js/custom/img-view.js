function previewFile(input) {
    "use strict";

    var preview = input.previousElementSibling;
    var file = input.files[0];
    var reader = new FileReader();


    if(input.files[0].size > 5000000){
        Swal.fire({
            icon: "warning",
            title: "Notification from the Global Education Platform!",
            text: "Maximum file size is 5000px!",
            showConfirmButton: false,
            timer: 1500,
        });
    } else {
        reader.onloadend = function() {
            preview.src = reader.result;
        };

        if (file) {
            reader.readAsDataURL(file);
        } else {
            preview.src = "";
        }
    }
}
