<div class="modal fade" id="viewPdf" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenter" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="pdf">
                    <i class="fa fa-folder-open"></i>
                    <strong id="modalHeadingViewPDF"> Setting Export PDF</strong>
                </h5>
                <button class="btn-close btn-outline-danger" type="button" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ Auth::user()->role_id == '1' ? route('management.project.pdf') : route('project.pdf') }}" method="get">
                            <div class="row g-2 mb-2">
                                <div class="mb-3 col-md-12">
                                    <div class="row">
                                        <div class="col-md-6 mb-2"> <label for="sort_by">Sort By</label>
                                            <select id="sort-project" name="sort_by" class="form-control sort-by"
                                                style="width: 100%;"></select>
                                        </div>
                                        <div class="col-md-6 mb-2"> <label for="category_name">Filter By</label>
                                            <select id="category" name="category_name" class="form-control category"
                                                style="width: 100%;"></select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-2">
                                <div class="mb-3 col-md-12">
                                    <label for="start_year">Pilih Tahun</label>
                                    <div class="row">
                                        <div class="col-md-6 mb-2">
                                            <select id="start_year" name="start_year" class="form-control start-year"
                                                style="width: 100%;"></select>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <select id="end_year" name="end_year" class="form-control start-year"
                                                style="width: 100%;"></select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-success">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
