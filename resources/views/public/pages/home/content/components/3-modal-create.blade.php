<div class="modal fade modalCreate" data-key="acm" id="modalCreate-acm">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="title-review">Create Review</h4>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="product-details col-lg-16 text-justify">
                <form id="formCreateProjectData" class="formCreateProjectData theme-form needs-validation"
                    method="post" onsubmit="enableInput()" action="" novalidate="">
                    @csrf
                    <div class="modal-body">
                        <div class="row g-3">
                            <div class="mb-3 col-md-4">
                                <x-input-label for="title" :value="__('Title')" />
                                <div class="input-group"><span class="input-group-text"><i class="icon-user"></i></span>
                                    <x-text-input placeholder="" value="{{ $key['title'] }}" id="title"
                                        class="create form-control" type="text" name="title" :value="$key['title']"
                                        disabled />
                                    <x-input-error :messages="$errors->get('title')" class="mt-2" />
                                    <div class="invalid-tooltip">Please enter
                                        title
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 col-md-4">
                                <x-input-label for="name" :value="__('Publisher')" />
                                <div class="input-group"><span class="input-group-text"><i class="icon-user"></i></span>
                                    <x-text-input placeholder="{{ $key['publisher'] }}" value="{{ $key['publisher'] }}"
                                        id="publisher" class="create form-control" type="text" name="publisher"
                                        :value="$key['publisher']" disabled />
                                    <x-input-error :messages="$errors->get('publisher')" class="mt-2" />
                                    <div class="invalid-tooltip">Please enter
                                        publisher
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 col-md-4">
                                <x-input-label for="type" :value="__('Type')" />
                                <div class="input-group"><span class="input-group-text"><i class="icon-user"></i></span>
                                    <x-text-input placeholder="{{ $key['type'] }}" value="{{ $key['type'] }}"
                                        id="type" class="create form-control" type="text" name="type"
                                        :value="$key['type']" disabled />
                                    <x-input-error :messages="$errors->get('type')" class="mt-2" />
                                    <div class="invalid-tooltip">Please enter
                                        type
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row g-3">
                            <div class="mb-3 col-md-4">
                                <x-input-label for="publication" :value="__('Publication Title')" />
                                <div class="input-group"><span class="input-group-text"><i class="icon-user"></i></span>
                                    <x-text-input placeholder="{{ $key['publication'] }}"
                                        value="{{ $key['publication'] }}" id="publication" class="create form-control"
                                        type="text" name="publication" :value="$key['publication']" disabled />
                                    <x-input-error :messages="$errors->get('publication')" class="mt-2" />
                                    <div class="invalid-tooltip">Please enter
                                        publication title
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 col-md-4">
                                <x-input-label for="year" :value="__('Publication Year')" />
                                <div class="input-group"><span class="input-group-text"><i class="icon-user"></i></span>
                                    <x-text-input placeholder="{{ $key['year'] }}" value="{{ $key['year'] }}"
                                        id="year" class="create form-control" type="text" name="year"
                                        :value="$key['year']" disabled />
                                    <x-input-error :messages="$errors->get('year')" class="mt-2" />
                                    <div class="invalid-tooltip">Please enter
                                        publication year
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 col-md-4">
                                <x-input-label for="cited" :value="__('Cited')" />
                                <div class="input-group"><span class="input-group-text"><i
                                            class="icon-user"></i></span>
                                    <x-text-input placeholder="0" value="0" id="cited"
                                        class="create form-control" type="text" name="cited" :value="0"
                                        disabled />
                                    <x-input-error :messages="$errors->get('cited')" class="mt-2" />
                                    <div class="invalid-tooltip">Please enter
                                        cited
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-3 col-md-12">
                                <label for="abstract">Abstract</label>
                                <div class="input-group">
                                    <textarea class="create" placeholder="" value="" name="abstracts" id="abstracts" cols="150"
                                        rows="5" disabled>{{ $key['abstract'] }}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-3 col-md-12">
                                <label for="authors">Authors</label>
                                <div class="input-group">
                                    <textarea class="create" placeholder="" value="" name="authors" id="authors" cols="150"
                                        rows="2" required disabled>@foreach ($key['authors'] as $author){{ $author }};@endforeach</textarea>
                                </div>
                            </div>
                        </div>
                        @if (isset($key['keywords']))
                            <div class="row">
                                <div class="mb-3 col-md-12">
                                    <label for="keywords">Keywords</label>
                                    <div class="input-group">
                                        <textarea class="create" placeholder="" value="" name="keywords" id="keywords" cols="150"
                                            rows="2" required disabled>@foreach ($key['keywords'] as $keyword){{ $keyword }};@endforeach</textarea>
                                    </div>
                                </div>
                            </div>
                        @endif
                        @if (isset($key['references']))
                        <div class="row">
                            @php
                                $i = 1;
                            @endphp
                            <div class="mb-3 col-md-12">
                                <label for="references">References</label>
                                <div class="input-group">
                                    <textarea class="create" placeholder="" value="" name="references" id="references" cols="150"
                                        rows="6" disabled>@foreach ($key['references'] as $references) {{ $i++ }}. {{ $references = preg_replace('/\d+[\.\s]+/', '', $references) }}@endforeach</textarea>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="ml-3 btn btn-load btn-primary btn-block">
                            Submit
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
