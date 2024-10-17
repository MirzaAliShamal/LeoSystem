<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<!-- include the BotDetect layout stylesheet -->
<link href="{{ captcha_layout_stylesheet_url() }}" type="text/css" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<style>
    .BDC_CaptchaImageDiv a{
        display: none;
    }
    img{
        border-radius: 33px !important;
    }
    .captcha{
        display: inline-block;
        gap: 5px;
        justify-content: center;
    }
</style>
<div class="row align-items-center">
    <div class="col-md-6 col-sm-12 captcha">

        <button type="button" class="btn-refresh">
            <i class="fa fa-refresh fa-lg m-lg-2"></i>
        </button>
{{--        {!! captcha_image_html('ExampleCaptcha') !!}--}}
        <img src="{{ route('captcha.generate') }}" alt="captcha">

{{--                {!! captcha_img() !!}--}}
    </div>
    <div class="col-md-6 col-sm-12">
        <input id="captcha" type="text" class="form-control text-lg-center @error('captcha') is-invalid @enderror" placeholder="Enter Captcha" name="captcha">
        @error('captcha')
            <span class="invalid-feedback">
                <strong>Captcha Was Invalid</strong>
            </span>
        @enderror
    </div>
</div>

<script>
    $(document).ready(function () {
        $("a[title ~= 'BotDetect CAPTCHA Library for Laravel']").removeAttr("style");
        $("a[title ~= 'BotDetect CAPTCHA Library for Laravel']").removeAttr("href");
        $("a[title ~= 'BotDetect']").removeAttr("style");
        $("a[title ~= 'BotDetect']").removeAttr("href");
        $("a[title ~= 'BotDetect']").css('visibility', 'hidden');

        $(".btn-refresh").click(function(){
            $refresh_button = $(this)
            $.ajax({
                type:'GET',
                data:{
                    "_token" : "{{ csrf_token() }}"
                },
                {{--url:"{{ route('refresh-captcha') }}",--}}
                url:"{{ route('captcha.refresh') }}",
                beforeSend:function (){
                    $refresh_button.find('i').addClass('fa-spin')
                },
                success:function(data){
                    // $(".captcha span").html(data.captcha);
                    $(".captcha img").attr('src',data.captcha);
                    $refresh_button.find('i').removeClass('fa-spin')
                },error:function (err) {
                    console.log(err)
                    $refresh_button.find('i').removeClass('fa-spin')
                }
            });

        });
    });
</script>
