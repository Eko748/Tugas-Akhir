<div class="modal fade modalCreate" data-key="{{ str_replace([':', '.', '/', '-'], '', $key['identifier']) }}"
    id="modalCreate-{{ str_replace([':', '.', '/', '-'], '', $key['identifier']) }}">
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
                                <x-input-label for="publicationType" :value="__('Type')" />
                                <div class="input-group"><span class="input-group-text"><i class="icon-user"></i></span>
                                    <x-text-input placeholder="{{ $key['publicationType'] }}"
                                        value="{{ $key['publicationType'] }}" id="type" class="create form-control"
                                        type="text" name="type" :value="$key['publicationType']" disabled />
                                    <x-input-error :messages="$errors->get('publicationType')" class="mt-2" />
                                    <div class="invalid-tooltip">Please enter
                                        type
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row g-3">
                            <div class="mb-3 col-md-4">
                                <x-input-label for="publicationName" :value="__('Publication Title')" />
                                <div class="input-group"><span class="input-group-text"><i class="icon-user"></i></span>
                                    <x-text-input placeholder="{{ $key['publicationName'] }}"
                                        value="{{ $key['publicationName'] }}" id="publicationName"
                                        class="create form-control" type="text" name="publication" :value="$key['publicationName']"
                                        disabled />
                                    <x-input-error :messages="$errors->get('publicationName')" class="mt-2" />
                                    <div class="invalid-tooltip">Please enter
                                        publication title
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 col-md-4">
                                <x-input-label for="publicationDate" :value="__('Publication Year')" />
                                <div class="input-group"><span class="input-group-text"><i class="icon-user"></i></span>
                                    <x-text-input placeholder="{{ $key['publicationDate'] }}"
                                        value="{{ $key['publicationDate'] }}" id="publicationDate"
                                        class="create form-control" type="text" name="year" :value="$key['publicationDate']"
                                        disabled />
                                    <x-input-error :messages="$errors->get('publicationDate')" class="mt-2" />
                                    <div class="invalid-tooltip">Please enter
                                        publication year
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 col-md-4">
                                <x-input-label for="citing_paper_count" :value="__('Cited')" />
                                <div class="input-group"><span class="input-group-text"><i
                                            class="icon-user"></i></span>
                                    <x-text-input placeholder="0" value="0" id="citing_paper_count"
                                        class="create form-control" type="text" name="cited" :value="0"
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
                                        rows="2" required disabled>
@if (isset($key['creators']))
@foreach ($key['creators'] as $value)
{{ $value['creator'] }};
@endforeach
@endif
</textarea>
                                </div>
                            </div>
                        </div>
                        @if (isset($key['keyword']))
                            <div class="row">
                                <div class="mb-3 col-md-12">
                                    <label for="keywords">Keywords</label>
                                    <div class="input-group">
                                        <textarea class="create" placeholder="" value="" name="keywords" id="keywords" cols="150"
                                            rows="2" required disabled>
@foreach ($key['keyword'] as $value)
{{ $value }};
@endforeach
</textarea>
                                    </div>
                                </div>
                            </div>
                        @endif
                        <div class="row">
                            <div class="mb-3 col-md-12">
                                @php
                                    use Symfony\Component\DomCrawler\Crawler;
                                    
                                    $ref = $key['url'][0]['value'];
                                    $response = $client->request('GET', $ref);
                                    $html = (string) $response->getBody();
                                    $crawler = new Crawler($html);
                                    $hitung = 1;
                                    $items = $crawler->evaluate('//p[@class="c-article-references__text"]')->each(function ($node) use (&$hitung) {
                                        return $hitung++ . '. ' . $node->text() . '.';
                                    });
                                    
                                @endphp
                                <label for="references">References</label>
                                <div class="input-group">
                                    <textarea class="create" placeholder="" value="" name="references" id="references" cols="150"
                                        rows="6" disabled>{{ implode("\n", $items) }}</textarea>
                                </div>
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
