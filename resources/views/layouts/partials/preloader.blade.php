@yield('css')
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

<div class="preloader">
    <div class="loading-text">
        <span>L</span>
        <span>O</span>
        <span>A</span>
        <span>D</span>
        <span>I</span>
        <span>N</span>
        <span>G</span>
    </div>
</div>

@yield('script')
@vite(['resources/js/custom.js'])
@yield('script-bottom')