<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WardellTech</title>
    <link rel="icon" href="/img/headingW.png">
    <link rel="stylesheet" href="assets/css/services.css">
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

    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

</head>


@include('layouts.partials.navbar')
<body class="bg-gray-100">
<section class="container mx-auto px-4 py-6 mt-21">

<div class="container my-5" style="padding-top: 120px">
    <h2 class="text-2xl font-bold mb-4">Explore Freelancers</h2>

    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
        @forelse ($freelancers as $freelancer)
            <div class="bg-white shadow rounded-lg p-4 flex flex-col items-center">
                <img src="{{ $freelancer->profile_photo ? asset('storage/' . $freelancer->profile_photo) : 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) . '&background=0D8ABC&color=fff' }}" class="w-24 h-24 object-cover rounded-full mb-2" alt="Profile">
                <h3 class="text-lg font-semibold">{{ $freelancer->name }}</h3>
                <p class="text-gray-600">{{ $freelancer->email }}</p>
                <span class="badge bg-success mt-2">Freelancer</span>
                <p class="text-secondary my-2 text-gray-600 text-center">
                    {{ \Illuminate\Support\Str::limit($freelancer->about_me, 30) }}
                    @if (strlen($freelancer->about_me) > 30)
                        <a href="{{ route('my-profile', $freelancer->id) }}" class="text-blue-600 font-bold hover:underline">See more</a>
                    @else
                        <a href="{{ route('my-profile', $freelancer->id) }}" class="text-blue-600 font-bold hover:underline">Show Profile</a>
                    @endif
                </p>
                <p class="ttext-gray-600">Bergabung Sejak {{ $freelancer->created_at->format('M d, Y') }}</p>

            </div>
        @empty
            <p>No freelancers found.</p>
        @endforelse
    </div>
</div>
</section>
@include('layouts.partials.footer')
</body>