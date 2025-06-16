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

</head>

@include('layouts.partials.navbar')
<body class="bg-gray-100">
<section class="container mx-auto px-4 py-6 mt-21" style="padding-top: 200px">
  <!-- Header Section -->
  <div class="flex justify-between items-center mb-6">
    <h1 class="text-3xl font-semibold">Periksa Layanan Terbaik Kami</h1>
  </div>

  <!-- Cards Section -->
  <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
    <!-- Card 1 -->
    @php
    $servicessorttedbyrating = $services->sortByDesc('average_rating');
    @endphp
    @foreach($servicessorttedbyrating->take(3) as $service)
        <a href="{{ url('services/' . $service->service_id) }}">
            <div class="bg-white shadow-md rounded-lg p-4">
                <img src="{{ asset('storage/' . $service->photo) }}" alt="{{ $service->overview . ' ' . $service->service_id }}" class="w-full max-h-40 object-cover rounded-lg">
                <h2 class="text-xl font-bold mt-2">{{ \Illuminate\Support\Str::limit($service->overview, 25) }}</h2>
                <div class="flex justify-between items-center mt-2">
                    <span class="text-yellow-500">
                        ⭐ {{ number_format($service->average_rating, 1) }} ({{ $service->rating_count }} reviews)
                    </span>

                    <h2 class="text-gray-700">Rp.{{ number_format($service->price) }}</h2>
                    
                </div>
                <span class="badge bg-secondary mt-2">{{$service->category}}</span>
            </div>
        </a>
    @endforeach
  </div>


  <!-- Our Services (Filter Section) -->
<div class="flex justify-between items-center mt-12 mb-6 relative">
  <h1 class="text-3xl font-semibold">Jasa Kami</h1>
  
  <!-- Icon Filter -->
  <!-- <button id="filterToggle" class="p-2 rounded-lg hover:bg-gray-100 transition">
    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
        d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2a1 1 0 01-.293.707L15 13.414V19a1 1 0 01-1.447.894l-4-2A1 1 0 019 17v-3.586L3.293 6.707A1 1 0 013 6V4z" />
    </svg>
  </button> -->

  <!-- Filter Dropdown -->
  <!-- <div class="flex justify-between items-center mt-12 mb-6 relative">
    <div id="filterMenu" class="absolute top-14 right-0 bg-white border rounded-lg shadow-md p-4 hidden z-10 w-64">
      <h2 class="font-semibold mb-2">Filter Services</h2>
      <div class="flex flex-col gap-2">
        <label><input type="checkbox" class="mr-2" value="ui" />UI Design</label>
        <label><input type="checkbox" class="mr-2" value="web" />Web Development</label>
        <label><input type="checkbox" class="mr-2" value="maintenance" />Maintenance</label>
      </div>
    </div>
    <input type="text" placeholder="Search..." name="search"class="border rounded-lg p-2 w-64" />
  </div> -->
</div>

<!-- Toggle Script -->
<script>
  document.addEventListener('DOMContentLoaded', function () {
    const toggleBtn = document.getElementById('filterToggle');
    const filterMenu = document.getElementById('filterMenu');

    toggleBtn.addEventListener('click', function () {
      filterMenu.classList.toggle('hidden');
    });

    // Optional: close dropdown if click outside
    document.addEventListener('click', function (e) {
      if (!toggleBtn.contains(e.target) && !filterMenu.contains(e.target)) {
        filterMenu.classList.add('hidden');
      }
    });
  });
</script>

<form method="GET" action="{{ url('/services') }}">
  <div class="p-4 rounded-md">
      <div class="grid grid-cols-1 md:grid-cols-4 gap-4 items-end">

    {{-- Search --}}
    <div>
        <label for="search" class="text-sm font-medium">Search</label>
        <input type="text" name="search" id="search" value="{{ request('search') }}"
              placeholder="e.g. logo design"
              class="w-full mt-1 p-2 border rounded-md shadow-sm text-sm" />
    </div>

    {{-- Categories --}}
    <div>
        <label class="text-sm font-medium">Category</label>
        <div class="flex gap-2 mt-1">
            @foreach ($allCategories as $category)
                <label class="inline-flex items-center text-sm">
                    <input type="checkbox" name="categories[]" value="{{ $category }}"
                        {{ is_array(request('categories')) && in_array($category, request('categories')) ? 'checked' : '' }}
                        class="form-checkbox text-primary" />
                    <span class="ml-1 capitalize">{{ $category }}</span>
                </label>
            @endforeach
        </div>
    </div>

    {{-- Min Rating --}}
    <div>
        <label for="min_rating" class="text-sm font-medium">Minimum Rating</label>
        <select name="min_rating" id="min_rating" class="w-full mt-1 p-2 border rounded-md text-sm">
            <option value="">Any</option>
            @for ($i = 5; $i >= 1; $i--)
                <option value="{{ $i }}" {{ request('min_rating') == $i ? 'selected' : '' }}>{{ $i }}+</option>
            @endfor
        </select>
    </div>

    {{-- Min Reviews + Button --}}
    <div>
        <label for="min_reviews" class="text-sm font-medium">Minimum Reviews</label>
        <input type="number" name="min_reviews" id="min_reviews"
              value="{{ request('min_reviews') }}"
              placeholder="e.g. 10"
              class="w-full mt-1 p-2 border rounded-md shadow-sm text-sm" />
    </div>

    </div>
  </div>
    

    {{-- Submit Button --}}
    <div class="mt-4 text-right">
        <button type="submit" class="px-4 py-2 bg-black text-white rounded-md hover:bg-gray-800 text-sm font-semibold">
            Apply Filters
        </button>
    </div>
</form>




  <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 " style="padding-top: 50px">
        @foreach($services as $service)
        <a href="{{ url('services/' . $service->service_id) }}">
            <div class="bg-white shadow-md rounded-lg p-4">
                <img src="{{ asset('storage/' . $service->photo) }}" alt="{{ $service->overview . ' ' . $service->service_id }}" class="w-full max-h-40 object-cover rounded-lg">
                <h2 class="text-xl font-bold mt-2">{{ \Illuminate\Support\Str::limit($service->overview, 25) }}</h2>
                <div class="flex justify-between items-center mt-2">
                    <span class="text-yellow-500">
                        ⭐ {{ number_format($service->average_rating, 1) }} ({{ $service->rating_count }} reviews)
                    </span>

                    <h2 class="text-gray-700">Rp.{{ number_format($service->price) }}</h2>
                    
                </div>
                <span class="badge bg-secondary mt-2">{{$service->category}}</span>
            </div>
        </a>
        @endforeach    
    </div>

    

    </section>
@include('layouts.partials.footer')
    </body>