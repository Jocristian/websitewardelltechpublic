<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WardellTech</title>
    <link rel="icon" href="/img/favicon.png">

    @vite([
    'node_modules/bootstrap/dist/css/bootstrap.min.css',
    'resources/css/fontawesome.min.css',
    'resources/css/landing.css',
    'resources/css/landing-responsive.css'])

</head>
<body>
<section class="hero-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="hero-section-text">
                    <a href="{{ route('/home') }}"><img alt="logo" class="w-auto" src="/img/logo-sm.png"></a>
                    <h1>Consulting Business and Services HTML Landing Page </h1>
                    <p>All in One Multipurpose HTML Landing page Template is 100% Responsive to give a perfect user
                        experince on all devices. </p>
                    <a href="#" class="button btn"><span><span>Purchase Now</span></span></a>
                </div>
            </div>
        </div>
    </div>
    <img src="/img/computer.png" alt="img" class="computer">
    <ul class="shaps-img">
        <li><img src="/img/shaps-1.png" alt="img"></li>
        <li><img src="/img/shaps-4.png" alt="img"></li>
    </ul>
</section>
<section class="gap">
    <div class="container">
        <div class="unique-demos">
            <h2>Demos</h2>
            <p>Click the below images to preview sample landing pages you can create</p>
        </div>
        <div class="row">
            <div class="col-lg-4 col-md-6 col-sm-6 Construction Consulting">
                <div class="demo">
                    <a href="{{ route('home') }}" target="_blank">
                        <figure>
                            <img alt="demo" class="w-100" src="/img/lead-gen.jpg">
                        </figure>
                        <h5>Lead Gen</h5></a>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6 Construction Consulting">
                <div class="demo">
                    <a href="{{ route('index-2') }}" target="_blank">
                        <figure>
                            <img alt="demo" class="w-100" src="/img/click-trhough.jpg">
                        </figure>
                        <h5>Click Trhough</h5></a>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6 Construction Consulting">
                <div class="demo">
                    <a href="{{ route('index-3') }}" target="_blank">
                        <figure>
                            <img alt="demo" class="w-100" src="/img/subscription.jpg">
                        </figure>
                        <h5>Subscription</h5></a>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6 Construction Consulting">
                <div class="demo">
                    <a href="{{ route('index-4') }}" target="_blank">
                        <figure>
                            <img alt="demo" class="w-100" src="/img/video.jpg">
                        </figure>
                        <h5 class="mb-0">Video</h5></a>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="responsivetheme" style="background-image: url(/img/bacgrond.jpg); ">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="responsive-togive">
                    <h3>100% responsive design</h3>
                    <p>All in One Multipurpose HTML Landing page Template is 100% Responsive to give a perfect user
                        experince on all devices.</p>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="responsive-togive-img">
                    <img alt="img" class="w-100" src="/img/laptop.png">
                </div>
            </div>
        </div>
    </div>
    <footer>
        <div class="container">
            <div class="book-free">
                <a href="#" class="button btn"><span><span>Purchase Now</span></span></a>
            </div>
            <p class="footer">2024 © websole | Consulting Business HTML Landing Page<a
                    href="https://themeforest.net/user/winsfolio/portfolio"> winsfolio</a></p>
        </div>
    </footer>
</div>

@vite('resources/js/custom.js')
</body>
