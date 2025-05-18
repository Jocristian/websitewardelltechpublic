@extends('layouts.profile')

@section("admindashboard")

<section>
   <!--=============== HEADER ===============-->
   <header class="header" id="header">
      <script>
         function toggleAddServiceForm() {
            const form = document.getElementById('addServiceForm');
            form.classList.toggle('d-none');
         }
      </script>


      <!-- Bootstrap CSS -->
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
      <!-- Bootstrap JS (for modal functionality) -->
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
      <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

         <div class="header__container">
            <a href="{{ route('my-profile', auth()->user()->id) }}" class="header__logo">
                <div class="sidebar__info mx-2">
                <h3><p class="text-end" class="font-semibold"> {{auth()-> user()->name }}</p></h3>
                <span> {{ auth()-> user()->email}} </span>
                </div>
               <div class="sidebar__img">
                <img 
                  src="{{ Auth::user()->profile_photo ? asset('storage/' . Auth::user()->profile_photo) : 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) . '&background=0D8ABC&color=fff' }}" 
                  style="height: 100%; width: auto;" 
                  alt="profile image">
            </div>
            </a>
            
            <button class="header__toggle" id="header-toggle">
               <i class="ri-menu-line"></i>
            </button>
         </div>
      </header>

   <!--=============== SIDEBAR ===============-->
   <nav class="sidebar" id="sidebar">
      <div class="sidebar__container">
        <a href="{{ route('home') }}">
         <div class="sidebar__user">
                <img alt="logo-heading" src="/img/logoheading.png" style="height: 50px">
                <div class="sidebar__info h5 my-2">
                    <h5 class="text-center my-2"><p style="font-size: 50px, font-family: Rubik">Wardell Tech</p></h5>
                </div>
         </div>
        </a>
         

         <div class="sidebar__content">
            <div>
               <h3 class="sidebar__title">MANAGE</h3>

               <div class="sidebar__list">

                <a href="{{ route('sections.users') }}" class="sidebar__link">
                     <i class="ri-profile-fill"></i>
                     <span>daftar pengguna</span>
               </a>
               <a href="{{ route('admindashboard') }}" class="sidebar__link">
                     <i class="ri-profile-fill"></i>
                     <span>Dashboard</span>
               </a>
               </div>
            </div>
            <div class="sidebar__actions">
         <div class="sidebar__actions">
            <form action="{{ route('logout') }}" method="POST">
               @csrf
               <button class="sidebar__link">
                  <i class="ri-logout-box-r-fill"></i>
                  <span>Log Out</span>
               </button>
            </form>
         </div>
      </div>
   </nav>

   <!--=============== MAIN ===============-->
<main class="main" id="main"> 
        <div class="container mx-auto p-4">
         <h1 class="text-2xl font-bold mb-4">Admin Dashboard</h1>

         {{-- Summary Cards --}}
         <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
            <div class="bg-white shadow p-4 rounded">
                  <h2 class="text-lg font-semibold">Total Services</h2>
                  <p class="text-3xl font-bold">{{ $servicesCount }}</p>
            </div>

            <div class="bg-white shadow p-4 rounded">
                  <h2 class="text-lg font-semibold">Total Orders</h2>
                  <p class="text-3xl font-bold">{{ $ordersCount }}</p>
            </div>

            <div class="bg-white shadow p-4 rounded">
                  <h2 class="text-lg font-semibold">Total Earnings</h2>
                  <p class="text-3xl font-bold text-green-600">Rp {{ number_format($earnings, 0, ',', '.') }}</p>
            </div>
         </div>

         {{-- Top 5 Services --}}
         <div class="bg-white shadow p-4 rounded mb-6">
            <h2 class="text-xl font-semibold mb-4">Top 5 Services by Order Volume</h2>
            <ul class="list-disc list-inside">
                  @foreach($topServices as $overview => $total)
                     <li>{{ $overview }} ({{ $total }} orders)</li>
                  @endforeach
            </ul>
         </div>

         {{-- Monthly Earnings Chart --}}
         <div class="bg-white shadow p-4 rounded mb-6">
            <h2 class="text-xl font-semibold mb-4">Monthly Earnings</h2>
            <canvas id="earningsChart"></canvas>
         </div>

         {{-- Order Statistics --}}
         <div class="bg-white shadow p-4 rounded">
            <h2 class="text-xl font-semibold mb-4">Order Status Breakdown</h2>
            <ul class="list-disc list-inside">
                  @foreach($orderStats as $status => $count)
                     <li>{{ ucfirst($status) }}: {{ $count }}</li>
                  @endforeach
            </ul>
         </div>
      </div>

      <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
      <script>
         const ctx = document.getElementById('earningsChart').getContext('2d');
         const earningsChart = new Chart(ctx, {
            type: 'bar',
            data: {
                  labels: {!! json_encode($monthLabels->toArray()) !!},
                  datasets: [{
                     label: 'Earnings (Rp)',
                     data: {!! json_encode($monthlyEarnings->values()) !!},
                     backgroundColor: 'rgba(59, 130, 246, 0.5)',
                     borderColor: 'rgba(59, 130, 246, 1)',
                     borderWidth: 1,
                  }]
            },
            options: {
                  scales: {
                     y: {
                        beginAtZero: true,
                        ticks: {
                              callback: value => 'Rp ' + new Intl.NumberFormat().format(value)
                        }
                     }
                  }
            }
         });
      </script>
</main>
</section>
@endsection
