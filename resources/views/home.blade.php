<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="apple-touch-icon" sizes="76x76" href="/apple-icon.png">
    <link rel="icon" type="image/png" sizes="96x96" href="/favicon.png">
    <link rel=manifest href=/manifest.json>
    <title>Auto Subastas RN2</title>
    <!-- Fonts -->
    <link rel="stylesheet" href="{{mix('css/app.css')}}">
</head>
<body>
<div id="app" class="">

</div>
</body>
<script src="{{mix('js/app.js')}}"></script>

</html>
