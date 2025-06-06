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
                        <i class="fas fa-user-circle" style="margin-top: 4px;"></i>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</header>
