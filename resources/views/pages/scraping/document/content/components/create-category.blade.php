<div class="col-xl-5 col-md-6 xl-100 col-lg-12 box-col-12">
    <div class="card b-r-primary b-t-primary border-3 card-absolute">
        <div class="pull-right card-header bg-grey b-l-primary b-r-primary border-3">
            <small>
                <h6 class="category" style="display: inline">Kategori</h6>
            </small>
        </div>
        <div class="card-body">
            <div class="tabbed-card">
                <ul class="pull-right nav nav-tabs border-tab nav-secondary" id="top-tabdanger" role="tablist">
                    <li class="nav-item"><a class="nav-link active" onclick="get()" id="profile-top-danger"
                            data-bs-toggle="tab" href="#tabCategory" role="tab" aria-controls="top-profiledanger"
                            aria-selected="true">
                            <p><i class="icofont icofont-man-in-glasses"></i>Kategori</p>
                        </a>
                        <div class="material-border"></div>
                    </li>
                    <li class="nav-item"><a class="nav-link" onclick="create()" id="contact-top-danger"
                            data-bs-toggle="tab" href="#tabCreateCategory" role="tab"
                            aria-controls="top-contactdanger" aria-selected="false">
                            <p><i class="icofont icofont-contacts"></i>Add</p>
                        </a>
                        <div class="material-border"></div>
                    </li>
                </ul>
                <br><br><br>
                <div class="tab-content" id="content-category">
                    <div class="tab-pane fade active show" id="tabCategory" role="tabpanel"
                        aria-labelledby="profile-top-tab">

                        @if (session()->has('message'))
                            <div class="alert alert-success outline alert-dismissible fade show" role="alert"><i
                                    data-feather="thumbs-up"></i>
                                <p><b> Well done! </b>{{ session()->get('message') }}</p>
                                <button class="btn-close" type="button" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif
                        @if (session()->has('error'))
                        <div class="alert alert-danger outline alert-dismissible fade show" role="alert"><i data-feather="alert-triangle"></i>
                            <p><b> It's Wrong! </b>{{ session()->get('error') }}</p>
                            <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                          </div>
                        @endif

                        <p>Permana</p>
                    </div>
                    <div class="tab-pane fade" id="tabCreateCategory" role="tabpanel" aria-labelledby="contact-top-tab">
                        <form id="formCreateCategory" class="theme-form needs-validation" method="POST"
                            action="{{ route('scraping.category.create') }}" novalidate="">
                            @csrf
                            <div class="form-group">
                                <x-input-label for="code" :value="__('Code')"></x-input-label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="icon-user"></i>
                                    </span>
                                    <x-text-input id="code" class="form-control" placeholder="ex: A-Z"
                                        type="text" name="code" :value="old('code')" required autofocus>
                                    </x-text-input>
                                    <x-input-error :messages="$errors->get('code')" class="mt-2">
                                        <div class="invalid-tooltip">
                                            Please enter code
                                        </div>
                                    </x-input-error>
                                </div>
                            </div>
                            <div class="form-group">
                                <x-input-label for="category_name" :value="__('Nama Kategori')"></x-input-label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="icon-user"></i>
                                    </span>
                                    <x-text-input id="category_name" class="form-control" placeholder="ex: IEEE etc..."
                                        type="text" name="category_name" :value="old('category_name')" required autofocus>
                                    </x-text-input>
                                    <x-input-error :messages="$errors->get('category_name')" class="mt-2">
                                        <div class="invalid-tooltip">
                                            Please enter category
                                        </div>
                                    </x-input-error>
                                </div>
                            </div>
                            <button type="submit" onclick="addCategory()" class="pull-right btn btn-primary btn-sm">
                                Tambah
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
