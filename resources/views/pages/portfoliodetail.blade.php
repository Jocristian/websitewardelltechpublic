<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WardellTech</title>
    <link rel="icon" href="/img/headingW.png">
    <link rel="stylesheet" href="assets/css/services.css">
    @yield('css')
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        .sticky-sidebar {
            position: sticky;
            top: 20px;
        }
        .product-image {
            object-fit: cover;
            border-radius: 10px;
        }
    </style>
</head>

@include('layouts.partials.navbar')

<body>
<div class="container" style="padding-top: 200px;">
    <div class="row g-4">
        <!-- Left: Portfolio Details -->
        <div class="col-lg-8">
            <!-- Image -->
            <div class="mb-4">
                <img src="{{ asset('storage/' . $portfolio->image) }}" class="w-100 product-image" style="height: 500px; object-fit: cover;" alt="{{ $portfolio->title }}">
            </div>

            <!-- Title and Description -->
            <h1 class="font-semibold mb-2">{{ $portfolio->title }}</h1>
            <p class="mb-4">{!! nl2br(e($portfolio->description)) !!}</p>
            <h4 class="mt-3 mb-5"> Link : <a href="{{ $portfolio->link }}">{{ $portfolio->link }}</a></h3>
        </div>

        <!-- Right: Sidebar -->
        <div class="col-lg-4">
            <div class="bg-white rounded-lg shadow sticky-sidebar text-center p-4">
                @if($portfolio->user->profile_photo)
                    <img src="{{ asset('storage/' . $portfolio->user->profile_photo) }}" alt="{{ $portfolio->user->name }}" class="w-20 h-20 rounded-full mx-auto mb-2 object-cover">
                @else
                    <img src="https://ui-avatars.com/api/?name={{ urlencode($portfolio->user->name) }}" alt="{{ $portfolio->user->name }}" class="w-20 h-20 rounded-full mx-auto mb-2">
                @endif

                <h3 class="font-semibold">{{ $portfolio->user->name }}</h3>
                <p class="text-gray-500">{{ $portfolio->user->email }}</p>
                <p class="text-sm text-gray-500"><strong>Role:</strong> Freelancer</p>
                <p class="text-sm text-gray-500">Member since {{ $portfolio->user->created_at->format('M d, Y') }}</p>

                <div class="mt-4">
                    <a href="{{ route('my-profile', $portfolio->user->id) }}" class="bg-gray-500 text-white text-sm px-3 py-1 rounded hover:bg-gray-700">Lihat Profil</a>
                </div>
            </div>
        </div>
    </div>
</div>

@include('layouts.partials.footer')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
