<header id="stickyHeader">
    <div class="container">
        <div class="top-bar" style="height: 120px;">
            <div class="logo mt-3">
                <a href="{{ route('home') }}">
                    <img alt="logo-heading" src="/img/logokunW.png">
                </a>`
            </div>
            <nav class="navbar">
                <ul class="navbar-links">
                    <li class="navbar-dropdown menu-item-children">
                    </li>
                    <li class="navbar-dropdown">
                        <a href="/"> Tentang </a>
                    </li>
                    <li class="navbar-dropdown">
                        <a href="{{ url('/services') }}">Jasa</a>
                    </li>
                    <li class="navbar-dropdown">
                        <a href="{{ url('/freelancers') }}">Freelancer</a>
                    </li>
                    <li class="navbar-dropdwon">
                        
                        <a href="{{ auth()->check() && auth()->user()->role == 'admin' ? url('/users') : (auth()->check() ? url('/profile') : url('/login')) }}">
                            @guest
                                <i class="fas fa-user-circle" style="margin-top: 4px;"></i>
                            @else
                           <div class="rounded-circle" style="width: 40px; height: 40px; overflow: hidden; border-radius: 50%; background-color: #fff;">
                            @if(auth()->user()->profile_photo)
                                <img 
                                src="{{ asset('storage/' . auth()->user()->profile_photo) }}" 
                                style="object-fit: cover; max-width: 100%;" 
                                alt="profile image">
                            @else
                                <img 
                                src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&background=0D8ABC&color=fff" 
                                style="object-fit: cover; max-width: 100%;" 
                                alt="profile image">
                            @endif
                            </div>
                            @endguest
                        </a>

                    </li>
                </ul>
            </nav>
        </div>
    </div>
</header>
