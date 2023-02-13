<div class="product-wrapper-grid">
    <div class="row">
        @if ($search != null)
            @foreach ($path as $key)
                <div class="col-xl-3 col-sm-6 xl-4">
                    <div class="card">
                        <div class="product-box">
                            <div class="product-img"><img class="img-fluid"
                                    src="https://brand-experience.ieee.org/favicon-32x32.png" alt="">
                                <div class="product-hover">
                                    <ul>
                                        <li><a href="cart.html"><i class="icon-shopping-cart"></i></a>
                                        </li>
                                        <li><a data-bs-toggle="modal" data-bs-target="#exampleModalCenter16"><i
                                                    class="icon-eye"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="modal fade" id="exampleModalCenter16">
                                <div class="modal-dialog modal-lg modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <div class="product-box row">
                                                <div class="product-img col-lg-6"><img class="img-fluid"
                                                        src="https://brand-experience.ieee.org/favicon-32x32.png"
                                                        alt=""></div>
                                                <div class="product-details col-lg-6 text-start"><a
                                                        href="product-page.html">
                                                        <h4>{{ $key['publisher'] }}</h4>
                                                    </a>
                                                    <div class="product-price">$26.00
                                                        <del>$35.00</del>
                                                    </div>
                                                    <div class="product-view">
                                                        <h6 class="f-w-600">Author:</h6>
                                                        <p class="mb-0">

                                                            {{ $key['abstract'] }}
                                                        </p>
                                                    </div>
                                                    <div class="product-size">
                                                        <ul>
                                                            <li>
                                                                <button class="btn btn-outline-light"
                                                                    type="button">M</button>
                                                            </li>
                                                            <li>
                                                                <button class="btn btn-outline-light"
                                                                    type="button">L</button>
                                                            </li>
                                                            <li>
                                                                <button class="btn btn-outline-light"
                                                                    type="button">Xl</button>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div class="product-qnty">
                                                        <h6 class="f-w-600">Quantity</h6>
                                                        <fieldset>
                                                            <div class="input-group">
                                                                <input class="touchspin text-center" type="text"
                                                                    value="5">
                                                            </div>
                                                        </fieldset>
                                                        <div class="addcart-btn"><a class="btn btn-primary me-3"
                                                                href="cart.html">Add to Cart </a><a
                                                                class="btn btn-primary" href="product-page.html">View
                                                                Details</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <button class="btn-close" type="button" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="product-details">
                                <div class="rating"><i class="fa fa-star"></i><i class="fa fa-star"></i><i
                                        class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>
                                </div><a href="product-page.html">
                                    <h5>{{ $key['title'] }}</h5>
                                </a>
                                <span>
                                    @php
                                        $cek = [];
                                        foreach ($key['authors'] as $author) {
                                            foreach ($author as $a) {
                                                // dd($a);
                                                $cek[] = $a;
                                                // $cek[] = $a;
                                            }
                                        }
                                    @endphp
                                    Authors:
                                </span>
                                @foreach ($cek as $name => $value)
                                    <p>
                                        - {{ $value['full_name'] }}
                                    </p>
                                @endforeach
                                <div class="product-price">$26.00
                                    <del>$35.00</del>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <center>
                <img id="img-scrap" class="text-center img-fluid" src="{{ asset('images/Search-Scraping.png') }}"
                    style="width:300px" alt="">
            </center>
        @endif
    </div>
</div>
