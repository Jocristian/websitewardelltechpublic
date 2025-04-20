<!DOCTYPE html>
<html lang="en">
<head>


    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WardellTech</title>
    <link rel="icon" href="/img/headingW.png">

    @yield('css')
    @vite([
    'node_modules/bootstrap/dist/css/bootstrap.min.css',
    'node_modules/owl.carousel/dist/assets/owl.carousel.min.css',
    'node_modules/owl.carousel/dist/assets/owl.theme.default.min.css',
    'node_modules/jquery.fancybox/source/jquery.fancybox.css',
    'resources/fonts/flaticon_mycollection.css',
    'resources/css/fontawesome.min.css',
    'resources/css/style.css',
    'resources/css/responsive.css'])

</head>
<body>
<!-- preloader -->
<div class="preloader">
    <div class="loading-text">
        <span>L</span>
        <span>O</span>
        <span>A</span>
        <span>D</span>
        <span>I</span>
        <span>N</span>
        <span>G</span>
    </div>
</div>

@include('layouts.partials.navbar')

@yield('content')

@include('sections.brands')
@include('sections.about')
@include('sections.services')
@include('sections.team')
@include('sections.faqs')
@include('sections.pricing')
@include('sections.reviews')
<!-- @include('sections.blog') -->
@include('sections.statistics')

@include('layouts.partials.footer')
@include('layouts.partials.back-to-top')

@yield('script')
@vite(['resources/js/custom.js','resources/js/contact.js'])
@yield('script-bottom')

</body>
