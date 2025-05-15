@extends('layouts.base')

@section('content')
    <section class="hero-section two">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="hero-text sec-title-animation animation-style2">
                        <span class="title-animation">Cara Terbaik Untuk </span>
                        <h2 class="title-animation">Membangun Bisnis Anda</h2>
                        <div class="d-flex listing">
                            <p>kita bisa membantu anda untuk membangun bisnis anda dengan cara terbaik dan freelancer yang bertalenta</p>
                        </div>
                    </div>
                    <a href="register" class="button btn"><span><span>Klik disini untuk memulai</span></span></a>
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
    @include('sections.team', ['freelancers' => $freelancers])
@endsection
