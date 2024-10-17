<div class="modal fade" style="border-radius: 33px;" id="{{ $id }}" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog d-table modal-dialog-centered" role="document">
        <div class="modal-content position-relative" style="border-radius: 33px;">
            <div class="modal-header">
                <div>
                    <h5 class="modal-title" id="modalLabel">
                        {{ $title }}
                    </h5>
                    <p class="text-xs"><small>{{ $subTitle }}</small></p>
                </div>
                <button type="button" class="close" style="font-size: 40px;" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body d-flex text-center items-center justify-content-center">
                <div id="parent-div">
                    <img id="{{ $imageId }}" style="max-height: 380px;object-fit: cover" src="https://avatars0.githubusercontent.com/u/3456749">
                </div>
{{--                <span id="loader" hidden class="fas fa-spinner fa-spin spinner position-absolute" style="color: #e5a825;"></span>--}}
{{--                <canvas style="top: 40%;background: yellow; height: 500px;width: 500px;"  id="percent-loader" hidden class="spinner position-absolute left-50" width="300" height="300">--}}
                <img id="loader" src="{{ asset('frontend/assets/gif/loader.gif') }}" hidden class="position-absolute left-50" style="width: 100px;height: 100px;object-fit: cover;top: 40%;" width="100%" height="100%" alt="loader">
            </div>
{{--            <div class="progress" style="margin:0 33px 33px 33px;">--}}
{{--                <div class="progress-bar" role="progressbar" style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">25%</div>--}}
{{--            </div>--}}
            <div class="modal-footer text-center justify-content-center" style="gap: 33px;">
                <button type="button" class="btn btn-secondary px-5 py-2" style="border-radius: 33px" data-bs-dismiss="modal">Cancel</button>
                <button type="button" style="border-radius: 33px" class="btn btn-warning px-5 py-2" id="crop">
                    {{ $cropButtonText }}
                    <span id="loader" hidden class="fas fa-spinner fa-spin"></span>
                </button>
            </div>
        </div>
    </div>
</div>