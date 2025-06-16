
    
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
        <h3 class="sidebar__title">MANAJEMEN</h3>

        <div class="sidebar__list">
          @if (auth()->user()->role == 'freelancer')
          <!-- Dashboard -->
          <a href="{{ route('dashboard') }}" class="sidebar__link {{ request()->is('dashboard') ? 'active-link' : '' }}">
            <i class="ri-dashboard-line"></i>
            <span>Dashboard</span>
          </a>
          @endif

          <!-- Edit Profile -->
          <a href="{{ route('profile') }}" class="sidebar__link {{ request()->is('profile') ? 'active-link' : '' }}">
            <i class="ri-user-settings-line"></i>
            <span>Edit Profil</span>
          </a>

          <!-- Recent Transactions -->
          <a href="{{ route('mytransactions') }}" class="sidebar__link {{ request()->is('mytransactions') ? 'active-link' : '' }}">
            <i class="ri-time-line"></i>
            <span>Transaksi Terbaru</span>
          </a>

          @if (auth()->user()->role == 'freelancer')
          <!-- My Services -->
          <a href="{{ route('myservices') }}" class="sidebar__link {{ request()->is('myservices') ? 'active-link' : '' }}">
            <i class="ri-briefcase-line"></i>
            <span>Jasa Saya</span>
          </a>

          <!-- My Portfolios -->
          <a href="/myportfolios" class="sidebar__link {{ request()->is('myportfolios') ? 'active-link' : '' }}">
            <i class="ri-gallery-line"></i>
            <span>Portofolio Saya</span>
          </a>

          <!-- My Messages -->
          <a href="{{ route('mymessages') }}" class="sidebar__link {{ request()->is('mymessages') ? 'active-link' : '' }}">
            <i class="ri-chat-1-line"></i>
            <span>Pesan Saya</span>
          </a>
          @endif

        </div>
      </div>

      <div class="sidebar__actions">
        <form action="{{ route('logout') }}" method="POST" name="logout-form">
          @csrf
          <button class="sidebar__link" name="logout-button">
            <i class="ri-logout-box-line text-danger"></i>
            <span class="text-danger">Keluar Dari Akun</span>
          </button>
        </form>
      </div>
    </div>
  </div>
</nav>