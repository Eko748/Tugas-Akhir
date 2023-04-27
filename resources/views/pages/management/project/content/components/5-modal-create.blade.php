<div class="card-body">
    <div class="modal fade" id="project" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modalHeadingCreateProject"></h4>
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="product-details col-lg-16 text-justify">
                    <form id="formCreateProject" class="theme-form" method="POST" action="" novalidate="">
                        @csrf
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form theme-form projectcreate">
                                        <div class="row mb-3">
                                            <div class="col-sm-10">
                                                <div class="mb-3">
                                                    <label>Subject</label>
                                                    <input name="subject" class="form-control" type="text"
                                                        placeholder="Input Subject..">
                                                </div>
                                            </div>
                                            <div class="col-sm-2">
                                                <div class="mb-3">
                                                    <label>Target</label>
                                                    <input name="target" class="form-control" type="number"
                                                        placeholder="Input Target..">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col">
                                            <div class="mb-3">
                                                <label>Description</label>
                                                <textarea name="description" placeholder="Input Detail Project.." class="form-control" id="exampleFormControlTextarea4"
                                                    rows="3"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-4 mt-3">
                                            <div class="mb-3">
                                                <label>Priority</label>
                                                <select name="priority" class="form-select">
                                                    <option value="P1">P1/Low</option>
                                                    <option value="P2">P2/Medium</option>
                                                    <option value="P3">P3/High</option>
                                                    <option value="P4">P4/Urgent</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-8 mt-3">
                                            <div class="mb-3">
                                                <label>Deadline</label>
                                                <div class="input-group">
                                                    <input class="form-control digits" type="text" name="date_range"
                                                        value="" data-position="top left">
                                                    <input type="hidden" name="start_date">
                                                    <input type="hidden" name="end_date">
                                                </div>
                                            </div>
                                        </div>
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
</div>
