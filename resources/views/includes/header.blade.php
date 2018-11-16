<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>World Meals</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Application Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
         <!-- My styles -->
        <link href="{{ asset('css/styles.css') }}" rel="stylesheet"> 

        <script src="{{ asset('js/app.js') }}"></script>

    </head>
    <body>
   
    @yield('content')