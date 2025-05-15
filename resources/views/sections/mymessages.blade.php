@extends('layouts.profile')

@section("mychats")  

<section>
   <!--=============== HEADER ===============-->
   <header class="header" id="header">

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
   <main class="main mx-5" id="main"> 
       <!-- In your Blade (e.g., chat-widget.blade.php) -->

<!-- Load TalkJS -->
<script>
(function(t,a,l,k,j,s){
s=a.createElement('script');s.async=1;s.src="https://cdn.talkjs.com/talk.js";a.head.appendChild(s)
;k=t.Promise;t.Talk={v:2,ready:{then:function(f){if(k)return new k(function(r,e){l.push([f,r,e])});l
.push([f])},catch:function(){return k&&new k()},c:l}};})(window,document,[]);
</script>

<!-- Floating button -->

<!-- Chat container -->
<div id="talkjs-container" style="
    bottom: 100px;
    right: 30px;
    width: 100%;
    height: 800px;
    background: white;
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 4px 12px rgba(0,0,0,0.3);
">
    <i>Loading chat...</i>

    <script>
    const user = {
        id: "{{ auth()->id() }}",
        name: "{{ auth()->user()->name }}",
        email: "{{ auth()->user()->email }}",
        photoUrl: "https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}",
    };

    window.addEventListener("load", function () {
        const chatContainer = document.getElementById('talkjs-container');
        chatContainer.style.display = 'block'; // Ensure it's visible

        Talk.ready.then(function () {
            const me = new Talk.User(user);

            const session = new Talk.Session({
                appId: "tYwY9u7r",
                me: me,
            });

            const inbox = session.createInbox(); // No 'selected'
            inbox.mount(chatContainer);
        });
    });
</script>

   </main>
</section>
@endsection