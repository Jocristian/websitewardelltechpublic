@extends('layouts.profile')

@section("mytransactions")

<section>
   <!--=============== HEADER ===============-->
   <header class="header" id="header">

      <!-- Bootstrap CSS -->
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
      <!-- Bootstrap JS (for modal functionality) -->
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
      <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

         <div class="header__container">
            <a href="{{ route('my-profile', auth()->user()->id) }}" style="height: 100%; width: auto;" class="header__logo" >
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

         <style>
            .card {
               transition: height 0.3s ease-in-out;
            }

            .card-body {
               padding: 10;
            }

            .collapse {
               padding: 0;
            }
            .star-rating {
               direction: rtl;
               display: inline-flex;
               font-size: 1.8rem;
            }

            .star-rating input[type="radio"] {
               display: none;
            }

            .star-rating label {
               color: #ccc;
               cursor: pointer;
               transition: color 0.2s;
            }

            .star-rating input[type="radio"]:checked ~ label {
               color: #f5b301;
            }

            .star-rating label:hover,
            .star-rating label:hover ~ label {
               color: #f5b301;
            }

         </style>

      </header>

   <!--=============== SIDEBAR ===============-->
@include('layouts.partials.sidenav')
   <!--=============== MAIN ===============-->
   <main class="main mx-5" id="main">
   <div class="container my-5">

        <!-- filter -->
   <form method="GET" action="{{ route('mytransactions') }}" class="mb-4">
      <div class="row g-2 align-items-end">

         <!-- {{-- Rentang Tanggal --}}
         <div class="col-md-2">
            <label for="start_date" class="form-label">Dari Tanggal</label>
            <input type="date" name="start_date" id="start_date" class="form-control"
               value="{{ request('start_date') }}">
         </div>

         <div class="col-md-2">
            <label for="end_date" class="form-label">Sampai Tanggal</label>
            <input type="date" name="end_date" id="end_date" class="form-control"
               value="{{ request('end_date') }}">
         </div> -->
         <div class="col-md-2">
         <label for="overview" class="form-label">Nama Jasa</label>
         <input type="text" name="overview" value="{{ request('overview') }}" class="form-control" placeholder="Masukkan Nama Jasa">
         </div>

         {{-- Rentang Harga --}}
         <div class="col-md-2">
            <label for="min_price" class="form-label">Harga Min</label>
            <input type="number" name="min_price" id="min_price" class="form-control"
               placeholder="0" value="{{ request('min_price') }}">
         </div>

         <div class="col-md-2">
            <label for="max_price" class="form-label">Harga Max</label>
            <input type="number" name="max_price" id="max_price" class="form-control"
               placeholder="999" value="{{ request('max_price') }}">
         </div>

         {{-- Status --}}
         <div class="col-md-2">
            <label for="status" class="form-label">Status</label>
            <select name="status" id="status" class="form-select">
               <option value="">Semua</option>
               <option value="on progress" {{ request('status') == 'on progress' ? 'selected' : '' }}>On Progress</option>
               <option value="finished" {{ request('status') == 'finished' ? 'selected' : '' }}>Finished</option>
               <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
            </select>
         </div>

         {{-- Sort --}}
         <div class="col-md-2">
            <label for="sort_price" class="form-label">Urutkan</label>
            <select name="sort_price" id="sort_price" class="form-select">
               <option value="">Harga</option>
               <option value="low_high" {{ request('sort_price') == 'low_high' ? 'selected' : '' }}>Termurah</option>
               <option value="high_low" {{ request('sort_price') == 'high_low' ? 'selected' : '' }}>Termahal</option>
            </select>
         </div>
         <div class="col-md-2">
            <select name="sort_date" id="sort_date" class="form-select">
               <option value="">Tanggal</option>
               <option value="newest" {{ request('sort_date') == 'newest' ? 'selected' : '' }}>Terbaru</option>
               <option value="oldest" {{ request('sort_date') == 'oldest' ? 'selected' : '' }}>Terlama</option>
            </select>
         </div>
      </div>
      {{-- Tombol --}}
      <div class="row">
            <div class="text-end mt-2">
               <button type="submit" class="btn btn-primary mx-2 w-20" style="padding-top: 5px ; padding-bottom: 5px">Filter</button>
               <!-- <a href="{{ route('mytransactions') }}" class="btn text-center">Reset</a> -->
            </div>
      </div>
   </form>



    <!-- Modal -->
    @if (auth() -> user() -> role == 'freelancer' )
         @foreach ($order as $order)
            @if ($order->status !== 'pending')
            <div class="card shadow-sm mb-4 border-0 rounded-4">
               <div class="card-body d-flex justify-content-between align-items-center flex-wrap">
                  <div class="d-flex align-items-center">
                        <a href="{{ url('services/' . $order->service->service_id) }}">
                        <img src="{{ asset('storage/' . $order->service->photo) }}" alt="Service Image"
                           class="rounded-3 me-4" style="height: 100px; width: 100px; object-fit: cover;">
                        </a>
                        <div>
                           <h5 class="mb-1">{{ $order->service->overview }}</h5>
                           <p class="mb-1 text-muted">Harga : <strong>${{ $order->service->price }}</strong></p>
                           <p class="mb-1 text-muted">Tengah Pengerjaan : <strong>{{ \Carbon\Carbon::parse($order->deadline)->diffForHumans() }}</strong></p>
                           <p class="mb-0">Status : 
                              <span class="badge 
                                    @if($order->status == 'on progress') bg-warning text-dark 
                                    @elseif($order->status == 'finished') bg-success 
                                    @else bg-secondary 
                                    @endif">
                                    {{ ucfirst($order->status) }}
                              </span>
                           </p>
                        </div>
                  </div>
                  
                  <div class="mt-3 mt-md-0 text-end">
                        <form method="POST" action="{{ route('order.updateStatus', $order->id) }}">
                           @csrf
                           @method('PUT')
                           <div class="mb-2 mx-2">
                              <select name="status" class="form-select form-select-sm">
                                    <option value="on progress" {{ $order->status == 'on progress' ? 'selected' : '' }}>On Progress</option>
                                    <option value="finished" {{ $order->status == 'finished' ? 'selected' : '' }}>Finished</option>
                              </select>
                              <button type="submit" class="btn btn-sm btn-primary w-100 mb-2 mt-2 mr-2">Update</button>
                              <button type="button" class="btn btn-sm btn-outline-secondary w-100" data-bs-toggle="modal" data-bs-target="#orderDetailsModal-{{ $order->id }}">
                                 Lihat Detail
                              </button>
                           </div>         
                        </form>
                  </div>
               </div>
            </div>

            <!-- Order Details Modal -->
            <div class="modal fade" id="orderDetailsModal-{{ $order->id }}" tabindex="-1" aria-labelledby="orderDetailsModalLabel-{{ $order->id }}" aria-hidden="true">
               <div class="modal-dialog modal-dialog-centered modal-lg">
                  <div class="modal-content rounded-4">
                        <div class="modal-header">
                           <h5 class="modal-title" id="orderDetailsModalLabel-{{ $order->id }}">Order Details</h5>
                           <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                           <p><strong>Order ID :</strong> {{ $order->id }}</p>
                           <p><strong>Jasa :</strong> {{ $order->service->overview }}</p>
                           <p><strong>Kebutuhan :</strong> {{ $order->details }}</p>
                           <p><strong>Harga :</strong> Rp{{ $order->service->price }}</p>
                           <p><strong>Tenggat Waktu :</strong> {{ \Carbon\Carbon::parse($order->deadline)->format('Y-m-d H:i:s') }}</p>
                           <p><strong>Status :</strong> 
                              <span class="badge 
                                    @if($order->status == 'on progress') bg-warning text-dark 
                                    @elseif($order->status == 'finished') bg-success 
                                    @else bg-secondary 
                                    @endif">
                                    {{ ucfirst($order->status) }}
                              </span>
                           </p>

                           @if ($order->status === 'finished' && $order->review)
                              <p><strong>Penilaian :</strong> {{ $order->rating }} / 5</p>
                              <p><strong>Ulasan :</strong> {{ $order->review }}</p>
                           @endif
                        </div>
                        <div class="modal-footer">
                           <button type="button" class="btn btn-secondary rounded-pill" data-bs-dismiss="modal">Close</button>
                        </div>
                  </div>
               </div>
            </div>
            @endif
            @endforeach

      @else (auth() -> user() -> role == 'customer' )
         @foreach ($order as $order)
            @if ($order->status !== 'pending')
            <div class="card mb-4">
                  <div class="card-body d-flex justify-content-between align-items-center">
                     <div class="d-flex align-items-center">
                        <a href="{{ url('services/' . $order->service->service_id) }}">
                           <img src="{{ asset('storage/' . $order->service->photo) }}" alt="Service" width="80" class="me-3 rounded">
                        </a>
                        <div> <div class="mb-2">
                              <h5 class>{{ $order->service->overview }}</h5>
                              </div>
                              <p class="mb-1">Price: <strong>Rp{{ $order->service->price }}</strong></p>
                              <p class="mb-1">Due In:
                                 <strong>
                                    {{ \Carbon\Carbon::parse($order->deadline)->diffForHumans() }}
                                 </strong>
                              </p>
                              <p>Status: 
                                 <span class="badge bg-{{ $order->status == 'finished' ? 'success' : 'primary' }}">
                                    {{ strtoupper($order->status) }}
                                 </span>
                              </p>
                        </div>
                     </div>

                     <div class="text-end col-4">
                        {{-- Show review form only if status is finished and not yet reviewed --}}
                       @if ($order->status === 'finished')
                        <!-- Tombol untuk membuka modal -->
                        <button type="button" class="btn btn-success w-50" data-bs-toggle="modal" data-bs-target="#reviewModal{{ $order->id }}">
                           Ulasan
                        </button>
                        <!-- Tombol hapus ulasan di tengah -->
                        <form action="{{ route('order.updateStatus', $order->id) }}" method="POST" 
                              onsubmit="return confirm('Yakin ingin menghapus ulasan?');" >
                           @csrf
                           @method('PUT')
                           <input type="hidden" name="delete_review" value="1">
                           <button type="submit" class="btn btn-danger mt-2 w-50">
                              Hapus Ulasan
                           </button>
                        </form>
                                 
                        <!-- Modal -->
                           <div class="modal fade" id="reviewModal{{ $order->id }}" tabindex="-1" aria-labelledby="reviewModalLabel{{ $order->id }}" aria-hidden="true">
                           <div class="modal-dialog">
                              <div class="modal-content">
                                 <form action="{{ route('order.updateStatus', $order->id) }}" method="POST">
                                 @csrf
                                 <div class="modal-header">
                                    <h5 class="modal-title" id="reviewModalLabel{{ $order->id }}">Ulasan untuk {{ $order->service->overview }}</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                                 </div>
                                 <div class="modal-body">
                                    <div class="mb-2">
                                       <label for="rating">Penilaian </label>
                                       <div class="star-rating">
                                       @for ($i = 5; $i >= 1; $i--)
                                          <input type="radio" id="star{{ $i }}_{{ $order->id }}" name="rating" value="{{ $i }}" required {{ $order->rating == $i ? 'checked' : '' }} />
                                          <label for="star{{ $i }}_{{ $order->id }}" title="{{ $i }} stars">&#9733;</label>
                                       @endfor
                                       </div>
                                    </div>
                                    <div class="mb-2">
                                       <textarea name="review" rows="3" class="form-control" placeholder="Tulis ulasan..." required>{{ $order->review }}</textarea>
                                    </div>
                                 </div>
                                 <div class="modal-footer">
                                    <div class="d-flex justify-content-end gap-2 w-100">
                                       <button type="submit" class="btn btn-success">Kirim Ulasan</button>
                                       <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                    </div>
                                 </div>
                                 </form>

                                 

                              </div>
                           </div>
                           </div>
                     @endif
                     </div>
                  </div>
            </div>
            @endif
         @endforeach
      @endif
      <div class="modal fade" id="orderUpdateModal" tabindex="-1" aria-labelledby="orderCompleteLabel" aria-hidden="true">
         <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content text-center p-4">
        <h4 class="modal-title text-success" id="orderCompleteLabel">🎉 Pesanan Diedit</h4>
        </div>
         </div>
    </div>

    <script>
       document.addEventListener('DOMContentLoaded', function () {
         const logoutForm = document.getElementById('logout-form');
         const modalElement = document.getElementById('orderUpdateModal');

         if (!logoutForm || !modalElement) return;

         const modal = new bootstrap.Modal(modalElement);

         document.querySelectorAll('form').forEach(function (form) {
            if (form !== logoutForm) {
               form.addEventListener('submit', function (e) {
               e.preventDefault();
               modal.show();
               // ...
               });

               // After showing modal, submit form for real
               setTimeout(() => {
               form.submit();
               }, 1500);
            }
         });
         });
    </script>
    @if(session('success'))
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const modal = new bootstrap.Modal(document.getElementById('orderUpdateModal'));
            modal.show();

            // Wait for the modal to be hidden before redirecting
            const modalElement = document.getElementById('orderUpdateModal');
            modalElement.addEventListener('hidden.bs.modal', function () {
                window.location.href = "/mytransactions"; // or any other redirect URL after modal closes
            });
        });
    </script>
    @endif
      <!-- <a href="" class="btn btn-outline-success">View</a> -->
   </div>
   </main>
</section>
@endsection