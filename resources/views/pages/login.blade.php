@extends('layouts.login')

@section('register')
    <section class="hero-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-7">
                    <div class="hero-text sec-title-animation animation-style2">
                        <span class="title-animation">Cara terbaik untuk </span>
                        <h2 class="title-animation">Mempromosikan Layanan Baru</h2>
                        <div class="d-flex listing">
                            <p>Kembangkan bisnismu bersama freelancer dengan membangun platform digitalmu sendiri untuk promosi.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5">
                    <form role="form" class="get-a-quote" id="contact-form" method="post" action="/login" style="margin-top: 45px;">
                        @csrf
                        <img src="/img/fom-img.png" alt="img">
                        <h3>Masuk</h3>
                        <h6>Email dan Kata Sandi</h6>
                        <input type="email" name="email" placeholder="Alamat Email" required="">
                        
                        <input type="password" name="password" placeholder="Kata Sandi" required="">
                        @error('email')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                        @error('password')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                        <button type="submit" class="button btn"><span><span>Masuk</span></span></button>
                        
                        <div class="text-center pt-3"><a class="text-center text-primary" href="register">Belum punya akun? Daftar</a></div>
                        <div class="text-center primary pt-3">
                            <strong>
                                <a class="text-center" href="/">
                                    <i class="fas fa-arrow-left"></i> Kembali
                                </a>
                            </strong>
                        </div>
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
    @include('layouts.partials.footer')
@endsection
