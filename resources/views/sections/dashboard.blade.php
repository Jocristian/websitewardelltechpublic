@extends('layouts.profile')

@section("dashboard")

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
@include('layouts.partials.sidenav')

   <!--=============== MAIN ===============-->
<main class="main" id="main"> 
        <div class="container my-5">
            <h2 class="mb-4">Dashboard</h2>

            <div class="row mb-4">
                <div class="col-md-4">
                    <div class="card p-3 text-center">
                        <strong>Jasa Saya</strong>
                        <h4>{{ $servicesCount }}</h4>
                    </div>
                </div>
                <!-- <div class="col-md-3"><div class="card p-3 text-center"><strong>Pesanan (sebagai Pembeli)</strong><h4>{{ $ordersAsBuyer }}</h4></div></div> -->
                <div class="col-md-4">
                    <div class="card p-3 text-center">
                        <strong>Pesanan Masuk</strong>
                        <h4>{{ $ordersAsSeller }}</h4>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card p-3 text-center">
                        <strong>Total Penghasilan</strong>
                        <h4>Rp.{{ $earnings }}</h4>
                    </div>
                </div>
            </div>
            <div class="row mb-4">
                <div class="col-md-4">
                    <div class="card p-4">
                        <h5 class="mb-3">Ringkasan Status Pesanan</h5>
                        <canvas id="statusChart"></canvas>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card p-4">
                        <h5 class="mb-3">Jasa Teratas Berdasarkan Pesanan</h5>
                        <canvas id="topServicesChart"></canvas>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card p-4">
                        <h5 class="mb-3">Penghasilan dari Waktu ke Waktu</h5>
                        <canvas id="earningsChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            const ctx = document.getElementById('statusChart');
            const statusChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: {!! json_encode($orderStats->keys()) !!},
                    datasets: [{
                        label: 'Number of Orders',
                        data: {!! json_encode($orderStats->values()) !!},
                        backgroundColor: ['#007bff', '#28a745', '#ffc107', '#dc3545'],
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: { display: false }
                    },
                    scales: {
                        y: { beginAtZero: true }
                    }
                }
            });
            const topServicesCtx = document.getElementById('topServicesChart');
            new Chart(topServicesCtx, {
                type: 'bar',
                data: {
                    labels: {!! json_encode($topServices->keys()) !!},
                    datasets: [{
                        label: 'Orders',
                        data: {!! json_encode($topServices->values()) !!},
                        backgroundColor: '#007bff',
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true
                        },
                        x: {
                            ticks: {
                                callback: function(value, index, ticks) {
                                    const label = this.getLabelForValue(value);
                                    const maxLength = 8; // Adjust as needed
                                    return label.length > maxLength ? label.substring(0, maxLength) + '…' : label;
                                },
                                maxRotation: 0,
                                minRotation: 0,
                            }
                        }
                    }
                }
            });

            const earningsCtx = document.getElementById('earningsChart');
            new Chart(earningsCtx, {
                type: 'line',
                data: {
                    labels: {!! json_encode($monthLabels) !!},
                    datasets: [{
                        label: 'Earnings ($)',
                        data: {!! json_encode($monthlyEarnings->values()) !!},
                        backgroundColor: 'rgba(40,167,69,0.2)',
                        borderColor: '#28a745',
                        borderWidth: 2,
                        tension: 0.3,
                        fill: true,
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: { beginAtZero: true }
                    }
                }
            });
        </script>
</main>
</section>
@endsection