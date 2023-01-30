{{-- 
<input type="hidden" name="hidden_page" id="hidden_page" value="1" />
<input type="hidden" name="hidden_column_name" id="hidden_column_name" value="id" />
<input type="hidden" name="hidden_sort_type" id="hidden_sort_type" value="asc" /> --}}
{{-- @include('inc.search') --}}
{{-- <div class="col-md-6"></div> --}}
    <div class="container-fluid user-card">
        <div id="load" class="row">
            @if (count($users) > 0)
                @foreach ($users as $key)
                    <div class="products col-md-6 col-lg-6 col-xl-4 box-col-4">
                        <div class="card custom-card">
                            <div class="card-header"><img class="img-fluid" src="../assets/images/user-card/1.jpg"
                                    alt="">
                            </div> 
                            <div class="card-profile"><img class="rounded-circle" src="../assets/images/avtar/3.jpg"
                                    alt="">
                            </div>
                            <div class="text-center profile-details">
                                <div class="user">
                                    @php
                                        $user = App\Models\User::find($key->id);
                                    @endphp
                                    <h4>
                                        <h5>{{ $user['name'] }}</h5>
                                    </h4>
                                </div>
                                <h6>{{ $user['email'] }}</h6>
                            </div>
                            <ul class="card-social">
                                <li><a href="https://www.facebook.com"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="https://accounts.google.com"><i class="fa fa-google-plus"></i></a></li>
                                <li><a href="https://twitter.com"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="https://www.instagram.com"><i class="fa fa-instagram"></i></a></li>
                                <li><a href="javascript:void(0)"><i class="fa fa-rss"></i></a></li>
                            </ul>
                            <div class="card-footer row">
                                <div class="col-4 col-sm-4">
                                    <h6>Follower</h6>
                                    <h3 class="counter">9564</h3>
                                </div>
                                <div class="col-4 col-sm-4">
                                    <h6>Following</h6>
                                    <h3><span class="counter">49</span>K</h3>
                                </div>
                                <div class="col-4 col-sm-4">
                                    <h6>Total Post</h6>
                                    <h3><span class="counter">96</span>M</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <h3>{!! $users->links() !!}</h3>
            @else
                <strong><span class="spinner-border spinner-border-sm"></span><h5> No Results Found</h5></strong>
            @endif
    </div>
