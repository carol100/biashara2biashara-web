<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>DIGITAL ADVOCACY</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <style>
        html, body {
            background-image: url({{url('images/welcome.png')}});
            background-repeat: no-repeat;
            background-size: cover;
            color: #23a7ff;
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
            height: 100vh;
            margin: 0;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 84px;
        }

        .links > a {
            color: #ffffff;
            padding: 0 25px;
            font-size: 15px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .m-b-md {
            margin-bottom: 30px;
        }
    </style>
</head>
<body>
<div class="flex-center position-ref full-height">

    @if (Route::has('login'))
        <div class="top-right links">
            <a href="{{ route('website.dashboard') }}" style="background: rgba(28,28,28,0.85); padding: 10px;">Portal</a>
            <a href="{{ route('employee.dashboard') }}" style="background: rgba(28,28,28,0.85); padding: 10px;">Employee</a>
        </div>
    @endif

    <div class="content">
        <div class="title m-b-md" style="background: rgba(28,28,28,0.48); padding: 10px;">
            DIGITAL ADVOCACY
        </div>

    </div>
</div>
</body>
</html>
