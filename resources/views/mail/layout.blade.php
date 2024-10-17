<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Email</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        @import url("https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800;900&display=swap");
        body {
            font-family: 'Montserrat', sans-serif;
            background-color: #f8f9fa;
            padding: 20px;
            text-align: center;
        }
        .main-title{
            font-size: 30px;
            text-align: center;
        }
        h1{
            text-align: center;
        }
        .email-container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border: 1px solid #e3e6f0;
            padding: 20px;
            border-radius: 10px;
            text-align: center;
        }
        .email-header {
            text-align: center;
            margin-bottom: 20px;
        }
        .email-header img {
            max-width: 300px;
            pointer-events: none;
            cursor: none;
        }
        .email-body {
            text-align: center;
            color: #333333;
        }
        .email-footer {
            text-align: center;
            margin-top: 20px;
            font-size: 12px;
            color: #666666;
        }
        .bg-yellow{
            background-color: #e3ab00;
        }
        .bg-yellow:hover{
            background-color: #a77e02;
        }
        .content{
            text-align: center;
            margin-top: 1rem;
            margin-bottom: 1rem;
        }
        .message{
            background-color: #e3ab00;
            padding: 15px;
            border-radius: 33px;
            margin: 20px 0;
            font-size: 14px;
            font-weight: bold;
        }
        .verify-button {
            color: #ffffff;
            padding: 10px 20px;
            border-radius: 33px;
            text-decoration: none;
            display: inline-block;
            margin-top: 20px;
            font-weight: bold;
            font-size: 20px;
        }
        .verify-button:hover{
            text-decoration: underline;
        }

        .social-icons {
            margin-top: 20px;
        }
        .social-icons img {
            width: 40px;
            margin: 0 5px;
            pointer-events: none;
        }
        .text-success{
            color: #02a01f;
        }
        .text-danger{
            color: #b00303;
        }
        @media only screen and (max-width: 600px) {
            .container {
                padding: 10px;
            }
            .header h1 {
                font-size: 20px;
            }
            .content h2 {
                font-size: 15px;
            }
            .message {
                font-size: 12px;
            }
        }
        a{
            color: #e3ab00;
        }
    </style>
</head>
<body>
<div class="email-container">
    <div class="email-header">
        <a href="#" style="cursor: none;">
            <img src="{{ asset('frontend/assets/img/leo-system.jpg') }}" onContextMenu="return false;">
        </a>
    </div>
    <div class="email-body">
        <h1 class="main-title">Global Education Platform</h1>
        <hr>
        <div class="content">
            @yield('content')
        </div>
    </div>
    <div class="email-footer">
        <p style="text-align: center;">This is an automated message, please do not reply.</p>
        <p style="text-align: center;">For more information please visit us at <a href="https://LeoSystem.com">LeoSystem.com</a></p>
        <strong style="margin-top: 15px;margin-bottom: 15px;font-size: 18px;">Stay Connected</strong>
        <div class="social-icons">
            <a href="#"><img src="{{ asset('frontend/assets/img/social/fb.png') }}" alt="Facebook"></a>
            <a href="#"><img src="{{ asset('frontend/assets/img/social/fb.png') }}" alt="Facebook"></a>
            <a href="#"><img src="{{ asset('frontend/assets/img/social/fb.png') }}" alt="Facebook"></a>
            <a href="#"><img src="{{ asset('frontend/assets/img/social/fb.png') }}" alt="Facebook"></a>
            <a href="#"><img src="{{ asset('frontend/assets/img/social/fb.png') }}" alt="Facebook"></a>
        </div>
        <p style="text-align: center; margin-top: 20px;">
            Thank you, The {{get_option('app_name')}} Team!<br>
            The Brand registered and protected in accordance with the law.<br>
            © 2023-2024 LeoSystem, All Rights Reserved.</p>
    </div>
</div>

<script>
    document.getElementsByName('img').mousedown(function (e) {
        if(e.button == 2) { // right click
            return false; // do nothing!
        }
    });
</script>
</body>
</html>



