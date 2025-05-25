@extends('layouts.profile')

@section("profile")
<section>
   <!--=============== HEADER ===============-->
   <header class="header" id="header">
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
         <!-- Bootstrap CSS -->
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
      <!-- Bootstrap JS (for modal functionality) -->
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
      <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
      <style>
         .profile-card {
            padding: 25px;
            border-radius: 12px;
            margin: 50px auto;
         }
         .profile-photo {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 50%;
            display: block;
            margin: 0 auto 15px auto;
         }
         .form-select:focus {
            background-color: #444;
            box-shadow: none;
            color: white;
         }
         .btn-primary {
            background-color: #4CAF50;
            border: none;
            padding: 10px 15px;
            border-radius: 6px;
            cursor: pointer;
         }
         .btn-primary:hover {
            background-color: #43a047;
         }
      </style>
   </header>
   </header>

   <!--=============== SIDEBAR ===============-->
@include('layouts.partials.sidenav')
   <!--=============== MAIN ===============-->
   <main class="main" id="main">
         <div class="profile-card">
         <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Profile Photo Preview -->
            @if (Auth::user()->profile_photo)
                  <img src="{{ asset('storage/' . Auth::user()->profile_photo) }}" class="profile-photo">
            @else
                  <img src="{{ asset('https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) . '&background=0D8ABC&color=fff') }}" class="profile-photo">
            @endif

            <!-- Full Name -->
            <div class="mb-3">
                  <label class="form-label"><strong>Nama Pengguna</strong></label>
                  <input type="text" name="name" class="form-control" value="{{ Auth::user()->name }}" required>
            </div>

            <!-- Email -->
            <div class="mb-3">
                  <label class="form-label"><strong>Email</strong></label>
                  <input type="email" class="form-control" value="{{ Auth::user()->email }}" readonly>
            </div>

            <!-- Phone Number -->
            <div class="mb-3">
                  <label class="form-label"><strong>Nomor Telepon</strong></label>
                  <input type="text" name="phone_number" class="form-control" value="{{ Auth::user()->phone_number }}" required>
            </div>

            <!-- About Me -->
            <div class="mb-3">
               <label class="form-label"><strong>Tentang Saya</strong></label>
               <textarea name="about_me" class="form-control" rows="4" placeholder="Tell us something about yourself">{{ Auth::user()->about_me }}</textarea>
            </div>


            <!-- Profile Photo -->
            <div class="mb-3">
                  <label class="form-label"><strong>Foto Profil</strong></label>
                  <input type="file" name="profile_photo" class="form-control">
            </div>

            <!-- Online Status -->
            <div class="mb-3">
                  <label class="form-label"><strong>Status Keaktifan</strong></label>
                  <select name="is_online" class="form-select">
                     <option value="1" {{ Auth::user()->is_online ? 'selected' : '' }}>Online</option>
                     <option value="0" {{ !Auth::user()->is_online ? 'selected' : '' }}>Offline</option>
                  </select>
            </div>

            <!-- Submit -->
            <button type="submit" class="btn btn-primary w-100">Save Changes</button>
         </form>
            <form class="my-2" action="{{ route('profile.destroy') }}" method="POST" onsubmit="return confirm('Apakah anda yakin anda ingin menghapus akun anda?');">
               @csrf
               @method('DELETE')
               <button type="submit" class="btn btn-danger w-100">Delete Account</button>
            </form>
         </div>
   </main>

</section>
@endsection