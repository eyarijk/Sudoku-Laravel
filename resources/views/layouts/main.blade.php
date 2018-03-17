<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="shortcut icon" href="favicon.png" type="image/png">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/normalize.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/demo.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/component.css') }}" />
    <link href='http://fonts.googleapis.com/css?family=Raleway:200,400,800' rel='stylesheet' type='text/css'>
    <title>Sudoku</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
<body>
<div class="demo-1">
    <div class="content">
        <div id="large-header" class="large-header">
            <canvas id="demo-canvas"></canvas>
            <div class="main-title" style="margin-bottom: 20px;">
                @yield('content')
                <p>Made with <span style="font-size: 25px">♥</span> by Mr Evrey</p>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('js/TweenLite.min.js') }}"></script>
<script src="{{ asset('js/EasePack.min.js') }}"></script>
<script src="{{ asset('js/rAF.js') }}"></script>
<script src="{{ asset('js/demo-1.js') }}"></script>
@yield('script')
</body>
</html>
