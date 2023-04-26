<div class="col-xl-6 col-md-6 dash-xl-50 box-col-12">
    <div class="card profile-greeting">
        <div class="card-body">
            <div class="media">
                <div class="media-body">
                    <div class="greeting-user">
                        <h1>Hallo, {{ Auth::user()->name }}</h1>
                        <p>Welcome back, your dashboard is ready!</p><a class="btn btn-outline-white_color"
                            href="blog_single">Get
                            Started<i class="icon-arrow-right"> </i></a>
                    </div>
                </div>
            </div>
            <div class="cartoon-img"><img class="img-fluid" src="{{ asset('assets/images/images.svg') }}" alt="">
            </div>
        </div>
    </div>
</div>
