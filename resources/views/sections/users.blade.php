@extends('layouts.profile')

@section("adminuser")

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
        <div class="container">
            <h2>Daftar Pengguna</h2>

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <table class="table">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->role }}</td>
                            <td>
                                @if($user->is_banned)
                                    <span class="badge bg-danger">Banned</span>
                                @else
                                    Aktif
                                @endif
                            </td>
                            <td>
                                @if(!$user->is_banned)
                                    <form method="POST" action="{{ route('sections.users.ban', $user->id) }}">
                                        @csrf
                                        <button class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin ban user ini?')">Ban</button>
                                    </form>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
      </div>
</main>
</section>
@endsection