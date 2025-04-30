@extends('layouts.login')

@section('register')
    <section class="hero-section";>
        <div class="container">
            <div class="row">
                <div class="col-lg-7">
                    <div class="hero-text sec-title-animation animation-style2">
                        <span class="title-animation">The best ways to </span>
                        <h2 class="title-animation">Promote a New Product or Service</h2>
                        <div class="d-flex listing">
                            <p>Scale up your business with the freelancer by building your own digital platform to promote.</p>
                        </div>
                    </div>
                    <div class="review">
                        <img alt="img" src="/img/google.png">`
                        <ul class="star">
                            <li><i class="fa-solid fa-star"></i></li>
                            <li><i class="fa-solid fa-star"></i></li>
                            <li><i class="fa-solid fa-star"></i></li>
                            <li><i class="fa-solid fa-star"></i></li>
                            <li><i class="fa-solid fa-star"></i></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-5">
                    <form role="form" class="get-a-quote" id="contact-form" method="post" action="/login" style="margin-top: 45px;"``>
                        @csrf
                        <img src="/img/fom-img.png" alt="img">
                        <h3>Login</h3>
                        <h6>Email and Password</h6>
                        <input type="email" name="email" placeholder="Email Address" required="">
                        @error('email')
                        <p class="text-red-200">{{ $message }}</p>
                        @enderror
                        <input type="password" name="password" placeholder="Password" required="">
                        @error('password')
                        <p class="text-red-200">{{ $message }}</p>
                        @enderror
                        <button type="submit" class="button btn"><span><span>Submit Now</span></span></button>
                        <!--   -->
                        <div class="text-center"><a class="text-center" href="register">aaaaaaaaa</a></div>
                    </form>
                    
                </div>
            </div>
        </div>
        <ul class="shaps-img">
            <li><img src="/img/shaps-4.png" alt="img"></li>
            <li><img src="/img/shaps-4.png" alt="img"></li>
            <li><img src="/img/shaps-1.png" alt="img"></li>
            <li><img src="/img/shaps-2.png" alt="img"></li>
            <li><img src="/img/shaps-3.png" alt="img"></li>
        </ul>
    </section>

@endsection
