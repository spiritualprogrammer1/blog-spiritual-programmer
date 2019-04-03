<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Single Page Forum</title>

    <!-- Fonts -->
    <meta name="csrf-token" content="{{csrf_token()}}">

    <!-- Styles -->
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
</head>
<body>
<div id="app">
    <v-app>

        <app-home></app-home>
        {{--<tool-bar>  </tool-bar>--}}



    </v-app>
</div>

<script src="{{asset('js/app.js')}}"></script>
</body>
</html>
