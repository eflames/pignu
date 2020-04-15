<?php
/**
 * Created by PhpStorm.
 * User: noten
 * Date: 3/11/2020
 * Time: 7:41 PM
 */?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <link rel="icon" type="image/x-icon" href="{{ asset('images/pignu/favicon.ico') }}">
    {!! SEO::generate(true) !!}

    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
    <link href="{{ asset('css/pignu/pignu-styles.min.css') }}" rel="stylesheet" type="text/css">
    @yield('after-styles')
</head>
<body class="sidebar-noneoverflow">

@include('pignu.partials.header')

<div class="main-container" id="container">

    <div class="overlay"></div>
    <div class="cs-overlay"></div>
    <div class="search-overlay"></div>

    @include('pignu.partials.sidebar')

    <div id="content" class="main-content">
        <div class="layout-px-spacing">
            @include('pignu.partials.alerts')

            @yield('content')

        </div>

        @include('pignu.partials.footer')
    </div>


</div>


<script src="{{ asset('js/pignu/pignu-scripts.min.js') }}"></script>
@yield('after-scripts')
</body>
</html>
