<!DOCTYPE html>
<html lang="en">
<head>

@include('layouts.partials.preloader')
@yield('register')

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WardellTech</title>
    <link rel="icon" href="/img/headingW.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

    @yield('css')
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

</head>
