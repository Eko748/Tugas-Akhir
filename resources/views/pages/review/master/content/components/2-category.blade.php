<div class="ribbon-wrapper card">
    <div class="card-body">
        <div class="ribbon ribbon-clip ribbon-secondary">
            Category
        </div>
        <div class="tabbed-card">
            <ul class="pull-right nav nav-tabs border-tab nav-secondary" id="top-tabdanger" role="tablist">
                <li class="nav-item"><a class="nav-link active" id="profile-top-danger"
                        data-bs-toggle="tab" href="#tabCategory" role="tab" aria-controls="top-profiledanger"
                        aria-selected="true">
                        <p><i class="icofont icofont-man-in-glasses"></i>Kategori</p>
                    </a>
                    <div class="material-border"></div>
                </li>
                <li class="nav-item"><a class="nav-link" id="contact-top-danger" data-bs-toggle="tab"
                        href="#tabCreateCategory" role="tab" aria-controls="top-contactdanger"
                        aria-selected="false">
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
                        <div class="alert alert-danger outline alert-dismissible fade show" role="alert"><i
                                data-feather="alert-triangle"></i>
                            <p><b> It's Wrong! </b>{{ session()->get('error') }}</p>
                            <button class="btn-close" type="button" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                        </div>
                    @endif

                    <p>Permana</p>
                </div>
                <div class="tab-pane fade" id="tabCreateCategory" role="tabpanel" aria-labelledby="contact-top-tab">
                    <form id="formCreateCategory" class="theme-form needs-validation" method="POST"
                        action="{{ route('review.category.create') }}" novalidate="">
                        @csrf
                        <div class="form-group mb-5">
                            <x-input-label for="category_code" :value="__('Code')"></x-input-label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="icon-user"></i>
                                </span>
                                <x-text-input id="category_code" class="form-control" placeholder="ex: A-Z" type="text"
                                    name="category_code" :value="old('category_code')" required autofocus>
                                </x-text-input>
                                <x-input-error :messages="$errors->get('category_code')" class="mt-2">
                                    <div class="invalid-tooltip">
                                        Please enter code
                                    </div>
                                </x-input-error>
                            </div>
                            {{-- @if (session()->has('error'))
                                @if ($error->has('code'))
                                    <span class="text-danger">{{ $errors->first('code') }}</span>
                                @endif
                            @endif --}}
                        </div>
                        <div class="form-group mb-4">
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
                                @if (session()->has('error'))
                                    @if ($error->has('category_name'))
                                        <span class="text-danger">{{ $errors->first('category_name') }}</span>
                                    @endif
                                @endif
                            </div>
                        </div>
                        <button type="submit" id="add-category" class="mt-4 pull-right btn btn-primary btn-sm">
                            Tambah
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
