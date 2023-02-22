<div class="product-wrapper-grid">
    <div class="row">
        @if ($search != null)
            @foreach ($path as $key)
                <div class="col-xl-3 col-sm-6 xl-4">
                    <div class="card">
                        <div class="product-box">
                            <div class="product-img">
                                <div class="text-start">
                                    <img class="img-fluid" style="width: 100px;"
                                        src="https://brand-experience.ieee.org/favicon-32x32.png" alt="">
                                </div>
                                <p><small>No. {{ $key['article_number'] }}</small></p>
                                <div class="product-hover">
                                    <ul>
                                        <li><a data-bs-toggle="modal"
                                                data-bs-target="#modalCreate-{{ $key['article_number'] }}"><i
                                                    class="icon-plus"></i></a></li>
                                        <li><a data-bs-toggle="modal"
                                                data-bs-target="#modalView-{{ $key['article_number'] }}"><i
                                                    class="icon-eye"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="modal fade" id="modalCreate-{{ $key['article_number'] }}">
                                <div class="modal-dialog modal-xl modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <div class="product-box row">
                                                <div class="product-img col-lg-1">
                                                    <img class="img-fluid"
                                                        src="https://brand-experience.ieee.org/favicon-32x32.png"
                                                        alt="">
                                                </div>
                                            </div>
                                            <button class="btn-close" type="button" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                        </div>
                                        <div class="product-details col-lg-16 text-justify">
                                            <form id="formCreateMember" class="theme-form needs-validation"
                                                method="POST" action="" novalidate="">
                                                @csrf
                                                <div class="modal-body">
                                                    <div class="row g-3">
                                                        <div class="mb-3 col-md-4">
                                                            <label for="category_id">Code</label>
                                                            <div class="input-group"><span
                                                                    class="input-group-text"><i
                                                                        class="icon-user"></i></span>
                                                                <select id="category_id"
                                                                    class="form-select is-invalid"
                                                                    name="category_id" required autofocus>
                                                                    <option value=""></option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="mb-3 col-md-4">
                                                            <label for="name">Span</label>
                                                            <div class="input-group"><span
                                                                    class="input-group-text"><i
                                                                        class="icon-user"></i></span>
                                                                <x-text-input id="name"
                                                                    class="form-control" type="text" placeholder="{{ $key['title'] }}"
                                                                    name="name" :value="old('name')" required
                                                                    autofocus disabled />
                                                                <x-input-error :messages="$errors->get('name')"
                                                                    class="mt-2" />
                                                                <div class="invalid-tooltip">Please enter
                                                                    name
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="mb-3 col-md-4">
                                                            <x-input-label for="name" :value="__('Code')" />
                                                            <div class="input-group"><span
                                                                    class="input-group-text"><i
                                                                        class="icon-user"></i></span>
                                                                <x-text-input id="name"
                                                                    class="form-control" type="text"
                                                                    name="name" :value="old('name')" required
                                                                    autofocus />
                                                                <x-input-error :messages="$errors->get('name')"
                                                                    class="mt-2" />
                                                                <div class="invalid-tooltip">Please enter
                                                                    name
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button class="btn btn-secondary" type="button"
                                                        data-bs-dismiss="modal">Close</button>
                                                    <button type="submit"
                                                        class="ml-3 btn btn-load btn-primary btn-block">
                                                        Submit
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal fade" id="modalView-{{ $key['article_number'] }}">
                                <div class="modal-dialog modal-xl modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <div class="product-box row">
                                                <div class="product-img col-lg-1"><img class="img-fluid"
                                                        src="https://brand-experience.ieee.org/favicon-32x32.png"
                                                        alt=""></div>
                                                <div class="product-details col-lg-10 text-justify"><a
                                                        href="product-page.html">
                                                        <h4>Publisher: {{ $key['publisher'] }}</h4>
                                                    </a>
                                                    <div class="product-price">
                                                        <span>Type: {{ $key['content_type'] }}</span>
                                                        <p class="pull-right">
                                                            Cited: {{ $key['citing_paper_count'] }}
                                                        </p>
                                                    </div>
                                                    <div class="product-price">
                                                        <span>Publication: {{ $key['publication_date'] }}</span>
                                                        {{-- <p class="pull-right">
                                                            Volume: {{ $key['volume'] }}
                                                        </p> --}}
                                                    </div>
                                                    <div class="product-view mb-2">
                                                        <div class="product-price">
                                                            <h2>{{ $key['title'] }}</h2>
                                                        </div>
                                                        <span>
                                                            <b class="f-w-600">Abstract:</b>
                                                        </span>
                                                        <p class="mb-0">
                                                            {{ $key['abstract'] }}
                                                        </p>
                                                    </div>
                                                    @php
                                                        $i = [];
                                                        $o = [];
                                                        $u = [];
                                                        foreach ($key['index_terms'] as $keyword) {
                                                            // foreach ($keyword as $k) {
                                                            //     $o[] = $k;
                                                            // }
                                                            $keyword['terms'];
                                                            // dd($keyword['terms']);
                                                            // $i[] = $keyword;
                                                        }
                                                        // foreach ($o as $y) {
                                                        //     $u[] = $y;
                                                        //     foreach ($u as $w) {
                                                        //         $i[] = $w;
                                                        //     }
                                                        // }
                                                    @endphp
                                                    <div class="col-xl-4 col-sm-4 xl-4 mb-1">
                                                        <b>
                                                            <span>Keywords:</span>
                                                        </b>
                                                    </div>
                                                    <div class="row">
                                                        @foreach ($keyword['terms'] as $keywords)
                                                            <div class="col-xl-1 col-sm-0 xl-1">
                                                            </div>
                                                            <div class="col-xl-5 col-sm-8 xl-6 mb-2">
                                                                <span class="btn btn-outline-primary">
                                                                    <span>
                                                                        {{ $keywords }}
                                                                    </span>
                                                                </span>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                    {{-- <div class="product-qnty">
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
                                                    </div> --}}
                                                </div>
                                                <div class="col-lg-1">

                                                </div>
                                            </div>
                                            <button class="btn-close" type="button" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="product-details">
                                <div class="product-price">
                                    {{ $key['title'] }}
                                </div>
                                <hr>
                                <div class="rating">
                                    <b>
                                        Publisher: {{ $key['publisher'] }}
                                    </b>
                                    <strong>
                                        <p>{{ $key['publication_title'] }}</p>
                                    </strong>
                                </div>
                                <span>
                                    @php
                                        $cek = [];
                                        foreach ($key['authors'] as $author) {
                                            foreach ($author as $a) {
                                                $cek[] = $a;
                                            }
                                        }
                                    @endphp
                                    <b>Authors:</b>
                                </span>
                                @foreach ($cek as $name => $value)
                                    @if ($value['full_name'] == [])
                                        <p>
                                            <b>Tidak tercatat!</b>
                                        </p>
                                    @else
                                        <p>
                                            - {{ $value['full_name'] }}
                                        </p>
                                    @endif
                                @endforeach
                                <hr>
                                <div class="product-price">
                                    {{ $key['content_type'] }}: {{ $key['publication_year'] }}
                                    <p class="pull-right">Cited: {{ $key['citing_paper_count'] }}</p>
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
