@extends('layouts.login')

@section('register')
    <section class="hero-section";>
        <div class="container">
            <div class="row">
                <div class="col-lg-7">
                    <div class="hero-text sec-title-animation animation-style2">
                        <span class="title-animation">The best ways to </span>
                        <h2 class="title-animation">Promote a New Service</h2>
                        <div class="d-flex listing">
                            <p>Scale up your business with the freelancer by building your own digital platform to promote.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5">
                    <form role="form" class="get-a-quote" id="contact-form" method="post" action="/register" >
                        @csrf
                        <img src="/img/fom-img.png" alt="img">
                        <h3>Register</h3>
                        <h6>Create Account</h6>
                        <input type="text" name="name" placeholder="Complete Name" required="">
                        @error('name')
                        <p class="text-red-200">{{ $message }}</p>
                        @enderror
                        <input type="email" name="email" placeholder="Email Address" required="">
                        @error('email')
                        <p class="text-red-200">{{ $message }}</p>
                        @enderror
                        <input type="password" name="password" placeholder="Password" required="">
                        @error('password')
                        <p class="text-red-200">{{ $message }}</p>
                        @enderror
                        <input type="number" name="phone_number" placeholder="Phone No" required="">
                        @error('number')
                        <p class="text-red-200">{{ $message }}</p>
                        @enderror
                        <p>Select your role</p>
                        <div class="d-flex align-items-center">
                            <div class="radio-button">
                                <input type="radio" id="VirtualIn-Office" name="role" value="customer" selected>
                                <label for="Virtual">Customer</label>
                            </div>
                            <div class="radio-button">
                                <input type="radio" id="css" name="role" value="freelancer">
                                <label for="css">Freelancer</label><br>
                            </div>
                            @error('role')
                        <p class="text-red-200">{{ $message }}</p>
                        @enderror
                        </div>
                        <button type="submit" class="button btn"><span><span>Submit Now</span></span></button>
                        <!--   -->
                        <div class="text-center pt-3"><a class="text-center" href="login">Have an Account?</a></div>
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
