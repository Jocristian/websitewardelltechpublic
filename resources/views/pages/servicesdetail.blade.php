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
    .overview-list li {
      margin-bottom: 0.5rem;
    }
  </style>
</head>

@include('layouts.partials.navbar')
<body>

<div class="container" style="padding-top: 200px;">
  <div class="row g-4">
    <!-- Left: Images + Details -->
    <div class="col-lg-8">
      <!-- Image carousel -->
      <div id="productCarousel" class="carousel slide mb-4" data-bs-ride="carousel">
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img src="{{ asset('storage/' . $services->photo) }}" style="width: 300px; height: 500px; object-fit: cover;" class="d-block w-100 product-image" alt="{{ $services->overview }}">
          </div>
        </div>
      </div>

      <!-- Description -->
        <h1>{{ $services->overview }}</h1>
        <p>{!! nl2br(e($services->description)) !!}</p>
      

      <!-- Overview -->
      <!-- <h5 class="mt-4">Overview</h5>
      <ul class="overview-list">
        <li>Custom-designed website for businesses and startups.</li>
        <li>Fully responsive layout for mobile and desktop.</li>
        <li>SEO-friendly and optimized for search engines.</li>
        <li>Integration with payment gateways, contact forms, and more.</li>
        <li>Fast loading speed and smooth user experience.</li>
        <li>Secure and scalable for future growth.</li>
      </ul> -->

      <!-- Reviews -->
      <h3 class="my-4">Ulasan</h5>
      @if($services->ordersWithReview->count() > 0)
          @foreach($services->ordersWithReview as $review)
              <div class="card mb-3">
                  <div class="card-body">
                      <h5 class="card-title">{{ substr($review->buyer->name, 0, 1) }}****{{ substr($review->buyer->name, -1) }}</h5>
                      <div class="card-text">
                          @for($i = 0; $i < $review->rating; $i++)
                              ⭐
                          @endfor
                          <br>
                          {{ $review->review }}
                      </div>
                  </div>
              </div>
          @endforeach
      @else
          <p>Belum Ada Ulasan</p>
      @endif
    </div>

    <!-- Right: Sidebar -->
    <div class="col-lg-4">
      <div class="bg-light p-4 rounded shadow sticky-sidebar">
        <div class="d-flex justify-content-between align-items-center mb-2">
        @php
          $averageRating = $services->ordersWithReview->avg('rating');
          $totalReviews = $services->ordersWithReview->count();
        @endphp
        @if($services->ordersWithReview->isNotEmpty())
            <span>⭐ {{ number_format($averageRating, 1) }} ({{ $totalReviews }} reviews)</span>
        @else
            <span>Belum ada ulasan</span>
        @endif
       
        </div>
        <h4 class="text-primary fw-bold">Rp{{ number_format($services->price, 0, ',', '.') }}</h4>


        @php
            $isOwner = $services->user_id === Auth::id();
            $isFreelancer = Auth::user()->role === 'freelancer';
        @endphp

        @if (!$isOwner && !$isFreelancer)
            <form method="POST" action="{{ route('order.quickCreate', $services->service_id) }}">
                @csrf
                <button type="submit" class="btn btn-primary w-100 my-2">Pesan</button>
            </form>
            <button class="btn btn-outline-dark w-100" id="chat-toggle-btn">Kontak Saya</button>
        @else
            <p class="text-danger text-center">You cannot order your own service or you are a freelancer.</p>
        @endif

        <div class="text-center mt-3">
          <a href="#"><i class="bi bi-share"></i>Bagi</a>
        </div>
      </div>
      <div class="bg-white rounded-lg shadow mt-4 text-center p-4">
              @if($services->user->profile_photo)
                  <img src="{{ asset('storage/' . $services->user->profile_photo) }}" alt="{{ $services->user->name }}" class="w-20 h-20 rounded-full mx-auto mb-2 object-cover">
              @else
                  <img src="https://ui-avatars.com/api/?name={{ urlencode($services->user->name) }}" alt="{{ $services->user->name }}" class="w-20 h-20 rounded-full mx-auto mb-2">
              @endif

              <h3 class="font-semibold">{{ $services->user->name }}</h3>
              <p class="text-gray-500">{{ $services->user->email }}</p>
              <p class="text-sm text-gray-500"><strong>Role:</strong> Freelancer</p>
              <p class="text-sm text-gray-500">Member since {{ $services->user->created_at->format('M d, Y') }}</p>
              <p class="text-sm text-gray-500"></p>

              <div class="mt-4 flex justify-center gap-2">
                  <a href="{{ route('my-profile', $user->id) }}" class="bg-gray-500 text-white text-sm px-3 py-1 rounded hover:bg-gray-700">Lihat Profil</a>
              </div>
          </div>

    </div>
  </div>
</div>

@include('layouts.partials.footer')
@include('components.chat-widget')

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
