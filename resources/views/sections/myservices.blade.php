@extends('layouts.profile')

@section("myservices")

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
      </header>

   <!--=============== SIDEBAR ===============-->
   <nav class="sidebar" id="sidebar">
      <div class="sidebar__container">
         <div class="sidebar__user">
            <div class="sidebar__img">
               <img src="{{ asset('img.team-1.jpg') }}" alt="image">
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


               <a href="" class="sidebar__link">
                     <i class="ri-pie-chart-2-fill"></i>
                     <span>Edit Profile</span>
                  </a>

                  <a href="" class="sidebar__link">
                     <i class="ri-wallet-3-fill"></i>
                     <span>My Wallet</span>
                  </a>


                  <a href="" class="sidebar__link">
                     <i class="ri-arrow-up-down-line"></i>
                     <span>Recent Transactions</span>
                  </a>

                  @if (auth() -> user() -> role == 'freelancer' )
                  <a href="{{ route('myservices') }}" class="sidebar__link {{ request()->is('myservices') ? 'active-link' : '' }}">
                     <i class="ri-arrow-up-down-line"></i>
                     <span>my services</span>
                  </a>
                  
                  <a href="" class="sidebar__link">
                        <i class="ri-mail-unread-fill"></i>
                        <span>My Messages</span>
                     </a>

                     <a href="" class="sidebar__link">
                        <i class="ri-notification-2-fill"></i>
                        <span>Notifications</span>
                     </a>
                  @endif

               </div>
            </div>
            <div class="sidebar__actions">
            <h3 class="sidebar__title">SETTINGS</h3>
               <button>
                  <i class="ri-moon-clear-fill sidebar__link sidebar__theme" id="theme-button">
                     <span>Theme</span>
                  </i>
               </button>
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
   <main class="main container ms-5 " id="main">
   <div class="row">   
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>My Services</h1>
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addServiceModal">
            Add Service
        </button>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="addServiceModal" tabindex="-1" aria-labelledby="addServiceModalLabel" aria-hidden="true">
        <div class="modal-dialog">
         <form action="{{ route('postservice') }}" method="POST" enctype="multipart/form-data" class="modal-content">
                  @csrf
                  <div class="modal-header">
                     <h5 class="modal-title" id="addServiceModalLabel">Add New Service</h5>
                     <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>

                  <div class="modal-body">
                     <div class="mb-3">
                           <label for="price" class="form-label">Price</label>
                           <input type="number" class="form-control" name="price" id="price" required>
                     </div>

                     <div class="mb-3">
                           <label for="overview" class="form-label">Overview</label>
                           <input type="text" class="form-control" name="overview" id="overview" required>
                     </div>

                     <div class="mb-3">
                           <label for="description" class="form-label">Description</label>
                           <textarea class="form-control" name="description" id="description" rows="3" required></textarea>
                     </div>

                     <div class="mb-3">
                           <label for="photo" class="form-label">Photo</label>
                           <input type="file" class="form-control" name="photo" id="photo" accept="image/*" required>
                     </div>
                     </div>

                     <div class="mb-3">
                        <label for="category" class="form-label mb-3">Category</label>
                        <select class="form-select" name="category" id="category" required>
                           <option value="" disabled selected>Select category</option>
                           <option value="mobile">Mobile</option>
                           <option value="web">Web</option>
                        </select>
                     </div>

                  <div class="modal-footer">
                     <button type="submit" class="btn btn-success">Submit</button>
                     <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                  </div>
               </form>
         </div>
      </div>
      </div>
      <p>Total services: {{ $services->count() }}</p>
      <div class="container-fluid">
<?php
      foreach($services as $service):
      // @foreach($services as $service)

      // <div class="card">
      //       <h3>'.$service->overview.'</h3>
      //       <p><strong>Category:</strong>'.$service->category.'</p>
      //       <p><strong>Description:</strong>'.$service->description.'</p>
      //       <p><strong>Price:</strong>'.number_format($service->price, 2).'</p>
      //       <img src="'.asset('storage/' . $service->photo).'" alt="Service Photo" style="width: 200px; height: auto;">
      // </div>
      echo '
         
            <div class="bg-white shadow-md rounded-lg p-4 mt-4 ms-5">
               <img src="'.asset('storage/' . $service->photo).'" alt="Business Website" class="w-full h-40 object-cover rounded-lg">
               <h2 class="text-xl font-bold mt-2">'.$service->overview.'aaaaaaaaaaaaaaaa' .$service->photo.'</h2>
               <div class="flex justify-between items-center mt-2">
               <span class="text-yellow-500">⭐ 4.8 (320 ratings)</span>
               <span class="text-gray-700">Rp'.number_format($service->price, 2).'</span>
               </div>
               <p class="text-gray-500 text-sm">Original Price: Rp1.500.000</p>
            </div>
         ';
      endforeach;
?>
</div>
   </main>
</section>
@endsection