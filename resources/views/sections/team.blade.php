<section id="team" class="gap team-section">
    <div class="container">
        <div class="heading sec-title-animation animation-style2">
            <span class="title-animation">Website that brings leads </span>
            <h2 class="title-animation">Meet our awesome people </h2>
            <p>Increase your efficiencies, and create a better experience for everyone involved. Automate your workflows
                with tools you use every day.</p>
        </div>
        
        <div class="row">
            @forelse ($freelancers as $freelancer)
                <div class="col-lg-4 col-md-6">
                    <div class="team">
                        <div class="expert-icon">
                            <a href="JavaScript:void(0)">
                                <i class="fa-solid fa-share-nodes"></i>
                            </a>
                            <ul class="icon-share">
                                <li><a href="JavaScript:void(0)"><i class="fa-brands fa-facebook-f"></i></a></li>
                                <li><a href="JavaScript:void(0)"><i class="flaticon-twitter"></i></a></li>
                            </ul>
                        </div>
                        <figure>
                            <img 
                            src="{{ $freelancer->profile_photo 
                                ? asset('storage/' . $freelancer->profile_photo) 
                                : asset('storage/'.'profile_photos/default-profile-image.jpg') }}" 
                            class="w-full h-full object-cover" 
                            alt="Profile">
                        </figure>
                        <span>Freelancer</span>
                        <h4>{{ $freelancer->name }}</h4>
                        <a href="callto:+12344502086"><i class="fa-solid fa-mobile-screen"></i><b>{{ $freelancer->email }}</b></a>
                    </div>
                </div>
            @empty
                <p>No freelancers found.</p>
            @endforelse
        </div>
        <div class="center review">
            <img alt="img" src="/img/google-w.png">
            <ul class="star">
                <li><i class="fa-solid fa-star"></i></li>
                <li><i class="fa-solid fa-star"></i></li>
                <li><i class="fa-solid fa-star"></i></li>
                <li><i class="fa-solid fa-star"></i></li>
                <li><i class="fa-solid fa-star"></i></li>
            </ul>
            <h6>(5.0) </h6>
        </div>
    </div>
    <ul class="shaps-img">
        <li><img src="/img/shaps-3.png" alt="img"></li>
        <li><img src="/img/shaps-5.png" alt="img"></li>
    </ul>
</section>
