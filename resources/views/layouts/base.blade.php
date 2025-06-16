<!DOCTYPE html>
<html lang="en">
<head>


    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WardellTech</title>
    <link rel="icon" href="/img/headingW.png">

    @yield('css')
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])


</head>
<body>
<!-- preloader -->
@include('layouts.partials.preloader')
@include('layouts.partials.navbar')

@yield('content')

@include('sections.brands')
@include('sections.about')
@include('sections.services')
@include('sections.faqs')
@include('sections.pricing')
@include('sections.reviews')
@include('sections.statistics')
@include('layouts.partials.footer')
@include('layouts.partials.back-to-top')

@yield('script')
@vite(['resources/js/custom.js','resources/js/contact.js'])
@yield('script-bottom')

</body>
