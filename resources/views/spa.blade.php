<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Vue SPA Demo</title>
</head>

<a href="{{route('admin_panel' )}}">admin</a>
<div id="app">
    <app></app>
</div>

<script src="{{ mix('js/app.js') }}"></script>
</body>
</html>
