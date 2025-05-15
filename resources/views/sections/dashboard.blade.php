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

                <a href="{{ route('dashboard') }}" class="sidebar__link">
                     <i class="ri-pie-chart-2-fill"></i>
                     <span>Dashboard</span>
                  </a>


                  <a href="{{ route('profile') }}" class="sidebar__link {{ request()->is('profile') ? 'active-link' : '' }}">
                     <i class="ri-pie-chart-2-fill"></i>
                     <span>Edit Profile</span>
                  </a>

                  <a href="{{ route('mytransactions') }}" class="sidebar__link {{ request()->is('mytransactions') ? 'active-link' : '' }}">
                     <i class="ri-arrow-up-down-line"></i>
                     <span>Recent Transactions</span>
                  </a>

                  @if (auth() -> user() -> role == 'freelancer' )
                  <a href="{{ route('myservices') }}" class="sidebar__link {{ request()->is('myservices') ? 'active-link' : '' }}">
                     <i class="ri-arrow-up-down-line"></i>
                     <span>My Services</span>
                  </a>
                  <a href="{{ route('mymessages') }}" class="sidebar__link {{ request()->is('mymessages') ? 'active-link' : '' }}">
                        <i class="ri-mail-unread-fill"></i>
                        <span>My Messages</span>
                  </a>
                  @endif

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
        <div class="container my-5">
            <h2 class="mb-4">Dashboard</h2>

            <div class="row mb-4">
                <div class="col-md-4"><div class="card p-3 text-center"><strong>My Services</strong><h4>{{ $servicesCount }}</h4></div></div>
                <!-- <div class="col-md-3"><div class="card p-3 text-center"><strong>Orders (as Buyer)</strong><h4>{{ $ordersAsBuyer }}</h4></div></div> -->
                <div class="col-md-4"><div class="card p-3 text-center"><strong>Orders</strong><h4>{{ $ordersAsSeller }}</h4></div></div>
                <div class="col-md-4"><div class="card p-3 text-center"><strong>Total Earnings</strong><h4>Rp.{{ $earnings }}</h4></div></div>
            </div>
            <div class="row mb-4">
                <div class="col-md-4">
                    <div class="card p-4">
                        <h5 class="mb-3">Order Status Overview</h5>
                        <canvas id="statusChart"></canvas>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card p-4">
                        <h5 class="mb-3">Top Services by Orders</h5>
                        <canvas id="topServicesChart"></canvas>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card p-4">
                        <h5 class="mb-3">Earnings Over Time</h5>
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