@extends('layouts.base')

@section('content')
    <section class="hero-section three" style="background-image: url(/img/line-img.jpg);">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="hero-text sec-title-animation animation-style2">
                        <span class="title-animation">Learn how to market a product</span>
                        <h2 class="title-animation">Need a strong product marketing strategy</h2>
                        <div class="d-flex listing">
                            <p>Start your business today with a great and strong landing page made to enhance the
                                marketers workflow.</p>
                        </div>
                    </div>
                    <div class="subscribe-text">
                        <img src="/img/paper-plan.png" alt="img">
                        <div>
                            <h3>Subscribe Newsletter </h3>
                            <p>Enter your email and get recent news and updates</p>
                        </div>
                        <form role="form" class="get-subscribee" id="subscribe-form" method="post">
                            <input type="email" name="Email_Address" placeholder="Enter your email here" required="">
                            <button type="submit" class="btn button"><span><span>Subscribe Now</span></span></button>
                        </form>
                    </div>
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
