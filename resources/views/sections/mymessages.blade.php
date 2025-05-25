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
@include('layouts.partials.sidenav')
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
                appId: "tvblcOqF",
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