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
<div class="p-30 relative">
            <img src="{{ asset('/img/blog-img-1.jpg') }}" alt="Client" class="w-1200 h-656 object-cover" style="margin-top: 120px">
            </div>
        </div>
<section class="container mx-auto px-4 py-6 mt-21">
  <!-- Header Section -->
  <div class="flex justify-between items-center mb-6">
    <h1 class="text-3xl font-semibold">Recommended</h1>
    <input type="text" placeholder="Search..." class="border rounded-lg p-2 w-64" />
  </div>

  <!-- Cards Section -->
  <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
    <!-- Card 1 -->
    <div class="bg-white shadow-md rounded-lg p-4">
      <img src="/img/blog-img-1.jpg" alt="Business Website" class="w-full h-40 object-cover rounded-lg">
      <h2 class="text-xl font-bold mt-2">Create a professional business website for productivity</h2>
      <div class="flex justify-between items-center mt-2">
        <span class="text-yellow-500">⭐ 4.8 (320 ratings)</span>
        <span class="text-gray-700">Rp1.200.000</span>
      </div>
      <p class="text-gray-500 text-sm">Original Price: Rp1.500.000</p>
    </div>

    <!-- Card 2 -->
    <div class="bg-white shadow-md rounded-lg p-4">
      <img src="/img/blog-img-2.jpg" alt="Portfolio Website" class="w-full h-40 object-cover rounded-lg">
      <h2 class="text-xl font-bold mt-2">Design a stunning portfolio or art website</h2>
      <div class="flex justify-between items-center mt-2">
        <span class="text-yellow-500">⭐ 4.7 (180 ratings)</span>
        <span class="text-gray-700">Rp950.000</span>
      </div>
      <p class="text-gray-500 text-sm">Original Price: Rp1.290.000</p>
    </div>

    <!-- Card 3 -->
    <div class="bg-white shadow-md rounded-lg p-4">
      <img src="/img/blog-img-3.jpg" alt="Online Banking Platform" class="w-full h-40 object-cover rounded-lg">
      <h2 class="text-xl font-bold mt-2">Develop an online banking or fintech platform</h2>
      <div class="flex justify-between items-center mt-2">
        <span class="text-yellow-500">⭐ 4.9 (400 ratings)</span>
        <span class="text-gray-700">Rp2.800.000</span>
      </div>
      <p class="text-gray-500 text-sm">Original Price: Rp3.500.000</p>
    </div>
  </div>


  <!-- Our Services (Filter Section) -->
<div class="flex justify-between items-center mt-12 mb-6 relative">
  <h1 class="text-3xl font-semibold">Our Services</h1>
  
  <!-- Icon Filter -->
  <button id="filterToggle" class="p-2 rounded-lg hover:bg-gray-100 transition">
    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
        d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2a1 1 0 01-.293.707L15 13.414V19a1 1 0 01-1.447.894l-4-2A1 1 0 019 17v-3.586L3.293 6.707A1 1 0 013 6V4z" />
    </svg>
  </button>

  <!-- Filter Dropdown -->
  <div id="filterMenu" class="absolute top-14 right-0 bg-white border rounded-lg shadow-md p-4 hidden z-10 w-64">
    <h2 class="font-semibold mb-2">Filter Services</h2>
    <div class="flex flex-col gap-2">
      <label><input type="checkbox" class="mr-2" value="ui" />UI Design</label>
      <label><input type="checkbox" class="mr-2" value="web" />Web Development</label>
      <label><input type="checkbox" class="mr-2" value="maintenance" />Maintenance</label>
    </div>
  </div>
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


  <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
    <!-- Card 1 -->
    <div class="bg-white shadow-md rounded-lg p-4">
      <img src="/img/blog-img-1.jpg" alt="Business Website" class="w-full h-40 object-cover rounded-lg">
      <h2 class="text-xl font-bold mt-2">Create a professional business website for productivity</h2>
      <div class="flex justify-between items-center mt-2">
        <span class="text-yellow-500">⭐ 4.8 (320 ratings)</span>
        <span class="text-gray-700">Rp1.200.000</span>
      </div>
      <p class="text-gray-500 text-sm">Original Price: Rp1.500.000</p>
    </div>

    <!-- Card 2 -->
    <div class="bg-white shadow-md rounded-lg p-4">
      <img src="/img/blog-img-2.jpg" alt="Portfolio Website" class="w-full h-40 object-cover rounded-lg">
      <h2 class="text-xl font-bold mt-2">Design a stunning portfolio or art website</h2>
      <div class="flex justify-between items-center mt-2">
        <span class="text-yellow-500">⭐ 4.7 (180 ratings)</span>
        <span class="text-gray-700">Rp950.000</span>
      </div>
      <p class="text-gray-500 text-sm">Original Price: Rp1.290.000</p>
    </div>

    <!-- Card 3 -->
    <div class="bg-white shadow-md rounded-lg p-4">
      <img src="/img/blog-img-3.jpg" alt="Online Banking Platform" class="w-full h-40 object-cover rounded-lg">
      <h2 class="text-xl font-bold mt-2">Develop an online banking or fintech platform</h2>
      <div class="flex justify-between items-center mt-2">
        <span class="text-yellow-500">⭐ 4.9 (400 ratings)</span>
        <span class="text-gray-700">Rp2.800.000</span>
      </div>
      <p class="text-gray-500 text-sm">Original Price: Rp3.501.000</p>
    </div>
  

    <?php
        foreach($services as $service):
        echo '
        
            <div class="bg-white shadow-md rounded-lg p-4">
                <img src="'.asset('storage/' . $service->photo).'" alt="Online Banking Platform" class="w-full h-40 object-cover rounded-lg">
                <h2 class="text-xl font-bold mt-2">'.$service->overview.'</h2>
                <div class="flex justify-between items-center mt-2">
                    <span class="text-yellow-500">⭐ 4.9 (400 ratings)</span>
                    <span class="text-gray-700">Rp.'.number_format($service->price).'</span>
                </div>
                <p class="text-gray-500 text-sm">Original Price: Rp3.500.000</p>
            </div>
        
        ';
    endforeach
    ?>
    </div>

    </section>
@include('layouts.partials.footer')
    </body>