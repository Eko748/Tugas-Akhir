<div class="col-xl-7 col-md-6 col-sm-12 xl-100 col-lg-12 box-col-12">
    <div class="card b-l-primary b-t-primary border-3 card-absolute">
        <div class="card-header bg-grey b-l-primary b-r-primary border-3">
            <small>
                <h6 class="scraping text-yellow" style="display: inline">Template</h6>
            </small>
        </div>
        <div class="card-body">
            <div class="tabbed-card">
                <ul class="pull-right nav nav-tabs border-tab nav-secondary" id="top-tabdanger" role="tablist">
                    <li class="nav-item"><a class="nav-link active" onclick="profile()" id="profile-top-danger"
                            data-bs-toggle="tab" href="#top-profiledanger" role="tab"
                            aria-controls="top-profiledanger" aria-selected="true">
                            <p><i class="icofont icofont-man-in-glasses"></i>Template</p>
                        </a>
                        <div class="material-border"></div>
                    </li>
                    <li class="nav-item"><a class="nav-link" onclick="contact()" id="contact-top-danger"
                            data-bs-toggle="tab" href="#top-contactdanger" role="tab"
                            aria-controls="top-contactdanger" aria-selected="false">
                            <p><i class="icofont icofont-contacts"></i>Contact</p>
                        </a>
                        <div class="material-border"></div>
                    </li>
                </ul>
                <br><br><br><br>
                <div class="tab-content" id="top-tabContentdanger">
                    <div class="tab-pane fade active show" id="top-profiledanger" role="tabpanel"
                        aria-labelledby="profile-top-tab">
                        <div class="stepwizard">
                            <div class="stepwizard-row setup-panel">
                                <div class="stepwizard-step"><a class="btn btn-primary" href="#step-1">1</a>
                                    <p>Step 1</p>
                                </div>
                                <div class="stepwizard-step"><a class="btn btn-light" href="#step-2">2</a>
                                    <p>Step 2</p>
                                </div>
                                <div class="stepwizard-step"><a class="btn btn-light" href="#step-3">3</a>
                                    <p>Step 3</p>
                                </div>
                                <div class="stepwizard-step"><a class="btn btn-light" href="#step-4">4</a>
                                    <p>Step 4</p>
                                </div>
                            </div>
                        </div>
                        <form action="{{ route('scraping.template.create') }}" method="POST">
                            <div class="setup-content" id="step-1">
                                <div class="col-xs-12">
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label class="control-label">Kategori</label>
                                            <select class="form-control" name="category_id" type="text" required="required">
                                                @foreach ($category as $category)
                                                <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label class="control-label">Icon</label>
                                            <input class="form-control" name="icon" type="text" placeholder="Deo"
                                                required="required">
                                        </div>
                                        <div class="mb-3">
                                            <label class="control-label">Title</label>
                                            <input class="form-control" name="title" type="text" placeholder="Deo"
                                                required="required">
                                        </div>
                                        <button class="btn btn-primary nextBtn pull-right" type="button">Next</button>
                                    </div>
                                </div>
                            </div>
                            <div class="setup-content" id="step-2">
                                <div class="col-xs-12">
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label class="control-label">Publication</label>
                                            <input class="form-control" name="publication" type="text" placeholder=""
                                                required="required">
                                        </div>
                                        <div class="mb-3">
                                            <label class="control-label">Year</label>
                                            <input class="form-control" name="year" type="text" placeholder=""
                                                required="required">
                                        </div>
                                        <div class="mb-3">
                                            <label class="control-label">Authors</label>
                                            <input class="form-control" name="authors" type="text" placeholder=""
                                                required="required">
                                        </div>
                                        <button class="btn btn-primary nextBtn pull-right" type="button">Next</button>
                                    </div>
                                </div>
                            </div>
                            <div class="setup-content" id="step-3">
                                <div class="col-xs-12">
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label class="control-label">Abstracts</label>
                                            <input class="form-control" name="abstracts" type="text" required="required">
                                        </div>
                                        <div class="mb-3">
                                            <label class="control-label">Keywords</label>
                                            <input class="form-control" name="keywords" type="text" placeholder="Keywords"
                                                required="required">
                                        </div>
                                        <div class="mb-3">
                                            <label class="control-label">Type</label>
                                            <input class="form-control" name="type" type="text" required="required">
                                        </div>
                                        <div class="mb-3">
                                            <label class="control-label">Publisher</label>
                                            <input class="form-control" name="publisher" type="text" placeholder="yes/No"
                                                required="required">
                                        </div>
                                        <button class="btn btn-primary nextBtn pull-right"
                                            type="button">Next</button>
                                    </div>
                                </div>
                            </div>
                            <div class="setup-content" id="step-4">
                                <div class="col-xs-12">
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label class="control-label">References</label>
                                            <input class="form-control" name="references" type="text" required="required">
                                        </div>
                                        <div class="mb-3">
                                            <label class="control-label">Bahasa</label>
                                            <input class="form-control" name="bahasa" type="text" placeholder="yes/No"
                                                required="required">
                                        </div>
                                        <div class="mb-3">
                                            <label class="control-label">Cited</label>
                                            <input class="form-control" name="cited" type="text" required="required">
                                        </div>
                                        <div class="mb-3">
                                            <label class="control-label">Citing</label>
                                            <input class="form-control" name="citing" type="text" placeholder="yes/No"
                                                required="required">
                                        </div>
                                        <button class="btn btn-secondary pull-right" type="submit">Finish!</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="tab-pane fade" id="top-contactdanger" role="tabpanel"
                        aria-labelledby="contact-top-tab">
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting
                            industry.
                            Lorem Ipsum has been the industry's standard dummy text ever since the
                            1500s, when an unknown printer took a galley of type and scrambled it to
                            make a type specimen book. It has survived not only five centuries, but
                            also
                            the leap into electronic typesetting, remaining essentially unchanged.
                            It
                            was popularised in the 1960s with the release of Letraset sheets
                            containing
                            Lorem Ipsum passages, and more recently with desktop publishing software
                            like Aldus PageMaker including versions of Lorem Ipsum.
                            Lorem Ipsum is simply dummy text of the printing and typesetting
                            industry.
                            Lorem Ipsum has been the industry's standard dummy text ever since the
                            1500s, when an unknown printer took a galley of type and scrambled it to
                            make a type specimen book. It has survived not only five centuries, but
                            also
                            the leap into electronic typesetting, remaining essentially unchanged.
                            It
                            was popularised in the 1960s with the release of Letraset sheets
                            containing
                            Lorem Ipsum passages, and more recently with desktop publishing software
                            like Aldus PageMaker including versions of Lorem Ipsum
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
