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
            <a href="{{ route('home') }}" class="header__logo">
               <span>WardellTech</span>
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
   <nav class="sidebar" id="sidebar">
      <div class="sidebar__container">
         <div class="sidebar__user">
            <div class="sidebar__img">
               <img 
                  src="{{ Auth::user()->profile_photo ? asset('storage/' . Auth::user()->profile_photo) : 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) . '&background=0D8ABC&color=fff' }}" 
                  style="height: 100%; width: auto;" 
                  alt="profile image">
            </div>

            <div class="sidebar__info">
               <h3> {{auth()-> user()->name }}</h3>
               <span> {{ auth()-> user()->email}} </span>
            </div>
         </div>

         <div class="sidebar__content">
            <div>
               <h3 class="sidebar__title">MANAGE</h3>

               <div class="sidebar__list">

               <a href="" class="sidebar__link">
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
                     <span>my services</span>
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
   <main class="main container" id="main"> 
        <!-- Button trigger modal -->



    <!-- Modal -->
    @if (auth() -> user() -> role == 'freelancer' )
         @foreach ($order as $order)
            <div class="card mb-3 p-3 d-flex flex-row align-items-center justify-content-between">
               <div class="d-flex align-items-center">
                  <img src="{{ asset('storage/' . $order->service->photo) }}" width="100" class="me-3 rounded">
                  <div>
                     <div><strong>{{ $order->service->overview }}</strong></div>
                     <div><strong>Price:</strong> ${{ $order->service->price }}</div>
                     <div><strong>Due In:</strong> {{ \Carbon\Carbon::parse($order->deadline)->diffForHumans() }}</div>
                  </div>
               </div>
            
               <form method="POST" action="{{ route('order.updateStatus', $order->id) }}">
                  @csrf
                  @method('PUT')
                  <select name="status" class="form-select">
                     <option value="on progress" {{ $order->status == 'on progress' ? 'selected' : '' }}>On Progress</option>
                     <option value="finished" {{ $order->status == 'finished' ? 'selected' : '' }}>Finished</option>
                  </select>
                  <button type="submit" class="btn btn-sm btn-primary mt-2">Update</button>
                  <button class="btn btn-sm btn-secondary mt-2" type="button" data-bs-toggle="modal" data-bs-target="#orderDetailsModal-{{ $order->id }}">
                  View Details
               </button>
               </form>
            
               <!-- View Details button -->
               
            </div>
            
            <!-- Order Details Modal -->
            <div class="modal fade" id="orderDetailsModal-{{ $order->id }}" tabindex="-1" aria-labelledby="orderDetailsModalLabel-{{ $order->id }}" aria-hidden="true">
               <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content">
                     <div class="modal-header">
                        <h5 class="modal-title" id="orderDetailsModalLabel-{{ $order->id }}">Order Details</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                     </div>
                     <div class="modal-body">
                        <p><strong>Order ID:</strong> {{ $order->id }}</p>
                        <p><strong>Service:</strong> {{ $order->service->overview }}</p>
                        <p><strong>Requirements:</strong> {{ $order->details }}</p>
                        <p><strong>Price:</strong> ${{ $order->service->price }}</p>
                        <p><strong>Deadline:</strong> {{ \Carbon\Carbon::parse($order->deadline)->format('Y-m-d H:i:s') }}</p>
                        <p><strong>Status:</strong> {{ $order->status }}</p>
                        @if ($order->status === 'finished' && $order->review)
                           <strong>Your Rating:</strong> {{ $order->rating }} / 5<br>
                           <strong>Review:</strong> {{ $order->review }}

                        @endif

                     </div>
                     <div class="modal-footer">
                        
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                     </div>
                  </div>
               </div>
            </div>
         @endforeach
      @else (auth() -> user() -> role == 'customer' )
         @foreach ($order as $order)
            <div class="card mb-4">
                  <div class="card-body d-flex justify-content-between align-items-center">
                     <div class="d-flex align-items-center">
                        <img src="{{ asset('storage/' . $order->service->photo) }}" alt="Service" width="80" class="me-3 rounded">
                        <div>
                              <h5>{{ $order->service->overview }}</h5>
                              <p class="mb-1">Price: <strong>${{ $order->service->price }}</strong></p>
                              <p class="mb-1">Due In:
                                 <strong>
                                    {{ \Carbon\Carbon::now()->diffForHumans($order->deadline, ['parts' => 2, 'short' => true, 'syntax' => \Carbon\CarbonInterface::DIFF_RELATIVE_TO_NOW]) }}
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
                        @if ($order->status === 'finished' && !$order->review)
                              <form action="{{ route('order.updateStatus', $order->id) }}" method="POST">
                                 @csrf
                                 <div class="mb-2">
                                    <label for="rating">Rating</label>
                                    <div class="star-rating">
                                       @for ($i = 5; $i >= 1; $i--)
                                             <input type="radio" id="star{{ $i }}" name="rating" value="{{ $i }}" required />
                                             <label for="star{{ $i }}" title="{{ $i }} stars">&#9733;</label>
                                       @endfor
                                    </div>
                                 </div>
                                 <div class="mb-4">
                                    <textarea name="review" rows="2" class="form-control" placeholder="Write your review..." required></textarea>
                                 </div>
                                 <button type="submit" class="btn btn-success">Submit Review</button>
                              </form>
                        @elseif ($order->review)
                              <div>
                                 <strong>Your Rating:</strong> {{ $order->rating }} / 5<br>
                                 <strong>Review:</strong> {{ $order->review }}
                              </div>
                        @endif
                     </div>
                  </div>
            </div>
         @endforeach
      @endif
      <div class="modal fade" id="orderUpdateModal" tabindex="-1" aria-labelledby="orderCompleteLabel" aria-hidden="true">
         <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content text-center p-4">
        <h4 class="modal-title text-success mb-3" id="orderCompleteLabel">🎉 Order Complete</h4>
        <p>Order Updated!</p>
        </div>
         </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const form = document.querySelector('form');
            const modalElement = document.getElementById('orderUpdateModal');

            if (!form || !modalElement) return;

            const modal = new bootstrap.Modal(modalElement);

            form.addEventListener('submit', function (e) {
                e.preventDefault(); // Prevent default submit
                modal.show(); // Show modal

                // After showing modal, submit form for real
                setTimeout(() => {
                    form.submit();
                }, 1500);
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
   </main>
</section>
@endsection