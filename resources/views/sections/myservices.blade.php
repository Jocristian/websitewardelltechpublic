@extends('layouts.profile')

@section("myservices")

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
<main class="main mt-4 mx-5" id="main"> 
        <!-- Button trigger modal -->
      <div class="d-grid gap-2">
         <button type="button" class="btn btn-outline-secondary btn-lg btn-block" onclick="toggleAddServiceForm()">
            Add Service
         </button>
      </div>



    <!-- Modal -->
         <div id="addServiceForm" class="mt-4 d-none">
            <form action="{{ route('postservice') }}" method="POST" enctype="multipart/form-data" class="border rounded p-4 shadow">
               @csrf
               <h5 class="mb-4">Add New Service</h5>

               <div class="mb-3">
                     <label for="price" class="form-label">Price</label>
                     <input type="number" class="form-control" name="price" id="price" oninput="this.value = this.value.slice(0, 7)" required>
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

               <div class="mb-3">
                     <label for="category" class="form-label mb-3">Category</label>
                     <select class="form-select" name="category" id="category" required>
                        <option value="" disabled selected>Select category</option>
                        <option value="mobile">Mobile</option>
                        <option value="web">Web</option>
                     </select>
               </div>

               <div class="d-flex justify-content-end">
                     <button type="submit" class="btn btn-success me-2">Submit</button>
                     <button type="button" class="btn btn-secondary" onclick="hideAddServiceForm()">Cancel</button>
               </div>
            </form>
         </div>


         @foreach ($services as $service)
            <div class="bg-white shadow-md rounded-lg p-4 mt-4 flex flex-row">
               <div class="w-1/6">
                     <a href="{{ url('services/' . $service->service_id) }}">
                        <img src="{{ asset('storage/' . $service->photo) }}" alt="Service Image" class="h-40 w-40 object-cover rounded-lg">
                     </a>
               </div>
               <div class="w-5/6 pl-4">
                     <h1 class="text-xl font-bold mt-2">{{ $service->overview }}</h1>
                     <div class="flex justify-between items-center mt-2">
                        <p>Average Rating: {{ number_format($service->average_rating, 1) }} ⭐ ({{ $service->rating_count }} reviews)</p>
                        <span class="text-gray-700">Rp{{ number_format($service->price, 2) }}</span>
                     </div>
                     <div class="d-grid gap-2">
                        <button type="button" class="btn btn-outline-secondary mt-2" data-bs-toggle="modal" data-bs-target="#editServiceModal{{ $service->service_id }}">
                           Edit Service
                        </button>
                        <form action="{{ route('services.destroy', $service->service_id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this service?');">
                           @csrf
                           @method('DELETE')
                           <button type="submit" class="btn btn-danger mt-2">Delete</button>
                        </form>
                     </div>
               </div>
            </div>
            <!-- Edit Modal -->
            <div class="modal fade" id="editServiceModal{{ $service->service_id }}" tabindex="-1" aria-labelledby="editServiceModalLabel{{ $service->service_id }}" aria-hidden="true">
            <div class="modal-dialog">
               <form action="{{ route('updateservice', $service->service_id) }}" method="POST" enctype="multipart/form-data" class="modal-content">
                  @csrf
                  @method('PUT')
                  <div class="modal-header">
                  <h5 class="modal-title" id="editServiceModalLabel{{ $service->service_id }}">Edit Service</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                  <div class="mb-3">
                     <label for="price{{ $service->service_id }}" class="form-label">Price</label>
                     <input type="number" class="form-control" name="price" id="price{{ $service->service_id }}" value="{{ $service->price }}" oninput="this.value = this.value.slice(0, 7)" required>
                  </div>

                  <div class="mb-3">
                     <label for="overview{{ $service->service_id }}" class="form-label">Overview</label>
                     <input type="text" class="form-control" name="overview" id="overview{{ $service->service_id }}" value="{{ $service->overview }}" required>
                  </div>

                  <div class="mb-3">
                     <label for="description{{ $service->service_id }}" class="form-label">Description</label>
                     <textarea class="form-control" name="description" id="description{{ $service->service_id }}" rows="3" required>{{ $service->description }}</textarea>
                  </div>

                  <div class="mb-3">
                     <label for="photo{{ $service->service_id }}" class="form-label">Photo</label>
                     <input type="file" class="form-control" name="photo" id="photo{{ $service->service_id }}" accept="image/*">
                  </div>


                  <div class="mb-3">
                     <label for="category{{ $service->service_id }}" class="form-label">Category</label>
                     <select class="form-select" name="category" id="category{{ $service->service_id }}" required>
                        <option value="mobile" {{ $service->category === 'mobile' ? 'selected' : '' }}>Mobile</option>
                        <option value="web" {{ $service->category === 'web' ? 'selected' : '' }}>Web</option>
                     </select>
                  </div>
                  </div>
                  <div class="modal-footer">
                  <button type="submit" class="btn btn-success">Save changes</button>
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                  </div>
               </form>
            </div>
            </div>
         @endforeach

</main>
</section>
@endsection