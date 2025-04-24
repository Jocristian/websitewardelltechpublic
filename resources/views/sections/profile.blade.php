@extends('layouts.profile')

@section("profile")
<section>
   <!--=============== HEADER ===============-->
   <header class="header" id="header">
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

               <a href="" class="sidebar__link active-link">
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
                  <a href="" class="sidebar__link">
                     <i class="ri-arrow-up-down-line"></i>
                     <span>portofolio</span>
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
   <main class="main container" id="main">
      <h1>Sidebar Menu</h1>
   </main>

</section>
@endsection