<div class="modal fade modalCreate" data-key="{{ $key['article_number'] }}" id="modalCreate-{{ $key['article_number'] }}">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="title-review">Create Review</h4>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="product-details col-lg-16 text-justify">
                <form id="" class="formCreateProjectData theme-form needs-validation" method="post"
                    onsubmit="enableInput()" action="" novalidate="">
                    @csrf
                    <input type="hidden" class="slr-code" name="reference_source" value="">
                    <div class="modal-body">
                        <div class="row g-2">
                            <div class="mb-3 col-md-6">
                                <label for="category">Category</label>
                                <div class="input-group">
                                    <select id="category" name="category_id" class="getCategory form-select">
                                    </select>
                                    <input type="hidden" name="code" class="code">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="project">List Project</label>
                                <div class="input-group">
                                    <select id="getProject" name="project_id" class="getProject form-select">
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row g-3">
                            <div class="mb-3 col-md-4">
                                <x-input-label for="title" :value="__('Title')" />
                                <div class="input-group"><span class="input-group-text"><i class="icon-user"></i></span>
                                    <x-text-input placeholder="" value="{{ $key['title'] }}"
                                        id="title-{{ $key['article_number'] }}" class="create form-control"
                                        type="text" name="title" :value="$key['title']" disabled />
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
                                        id="publisher-{{ $key['article_number'] }}" class="create form-control"
                                        type="text" name="publisher" :value="$key['publisher']" disabled />
                                    <x-input-error :messages="$errors->get('publisher')" class="mt-2" />
                                    <div class="invalid-tooltip">Please enter
                                        publisher
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 col-md-4">
                                <x-input-label for="type" :value="__('Type')" />
                                <div class="input-group"><span class="input-group-text"><i class="icon-user"></i></span>
                                    <x-text-input placeholder="{{ $key['content_type'] }}"
                                        value="{{ $key['content_type'] }}" id="type-{{ $key['article_number'] }}"
                                        class="create form-control" type="text" name="type" :value="$key['content_type']"
                                        disabled />
                                    <x-input-error :messages="$errors->get('type')" class="mt-2" />
                                    <div class="invalid-tooltip">Please enter
                                        type
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row g-3">
                            <div class="mb-3 col-md-4">
                                <x-input-label for="publication_title" :value="__('Publication Title')" />
                                <div class="input-group"><span class="input-group-text"><i class="icon-user"></i></span>
                                    <x-text-input placeholder="{{ $key['publication_title'] }}"
                                        value="{{ $key['publication_title'] }}"
                                        id="publication_title-{{ $key['article_number'] }}" class="create form-control"
                                        type="text" name="publication" :value="$key['publication_title']" disabled />
                                    <x-input-error :messages="$errors->get('publication_title')" class="mt-2" />
                                    <div class="invalid-tooltip">Please enter
                                        publication title
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 col-md-4">
                                <x-input-label for="publication_year" :value="__('Publication Year')" />
                                <div class="input-group"><span class="input-group-text"><i class="icon-user"></i></span>
                                    <x-text-input placeholder="{{ $key['publication_year'] }}"
                                        value="{{ $key['publication_year'] }}"
                                        id="publication_year-{{ $key['article_number'] }}"
                                        class="create form-control" type="text" name="year" :value="$key['publication_year']"
                                        disabled />
                                    <x-input-error :messages="$errors->get('publication_year')" class="mt-2" />
                                    <div class="invalid-tooltip">Please enter
                                        publication year
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 col-md-4">
                                <x-input-label for="citing_paper_count" :value="__('Cited')" />
                                <div class="input-group"><span class="input-group-text"><i
                                            class="icon-user"></i></span>
                                    <x-text-input placeholder="{{ $key['citing_paper_count'] }}"
                                        value="{{ $key['citing_paper_count'] }}"
                                        id="citing_paper_count-{{ $key['article_number'] }}"
                                        class="create form-control" type="text" name="cited" :value="$key['citing_paper_count']"
                                        disabled />
                                    <x-input-error :messages="$errors->get('citing_paper_count')" class="mt-2" />
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
                                    <textarea class="create" placeholder="" value="" name="abstracts"
                                        id="abstracts-{{ $key['article_number'] }}" cols="150" rows="5" disabled>{{ $key['abstract'] }}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-3 col-md-12">
                                @php
                                    $authors = [];
                                    foreach ($key['authors'] as $author) {
                                        foreach ($author as $a) {
                                            $authors[] = $a;
                                        }
                                    }
                                @endphp
                                @if ($authors)
                                    <label for="authors">Authors</label>
                                    <div class="input-group">
                                        <textarea class="create" value="" name="authors" id="authors-{{ $key['article_number'] }}" cols="150"
                                            rows="2" required disabled>
@foreach ($authors as $author)
{{ trim($author['full_name']) }};
@endforeach
</textarea>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-3 col-md-12">
                            @php
                                $a = [];
                                foreach ($key['index_terms'] as $keyword) {
                                    $a = $keyword['terms'];
                                }
                            @endphp
                            @if (isset($a))
                                <label for="keywords">Keywords</label>
                                <div class="input-group">
                                    <textarea class="create" value="" name="keywords" id="keywords-{{ $key['article_number'] }}" cols="150"
                                        rows="3" disabled>
@foreach ($a as $value)
{{ trim($value) }};
@endforeach
</textarea>
                            @endif
                        </div>
                    </div>
            </div>
            <div class="row">
                <div class="mb-3 col-md-12">
                    @php
                        $crawler = $client->request('GET', $references . $key['article_number']);
                        $text = $crawler->filterXPath('//body/text()[1]')->text();
                    @endphp
                    @if (isset($text))
                        <label for="keywords">References</label>
                        <div class="input-group">
                            <textarea class="create" value="ieee" name="references" id="references-{{ $key['article_number'] }}"
                                cols="150" rows="6" disabled>{{ $text }}</textarea>
                        </div>
                    @endif
                </div>
            </div>
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
@include('pages.review.components.2-get-category-js')
@include('pages.review.components.3-get-project-js')
