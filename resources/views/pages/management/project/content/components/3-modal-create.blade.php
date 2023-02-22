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
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="form theme-form projectcreate">
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="mb-3">
                                                            <label>Project Title</label>
                                                            <input name="title" class="form-control" type="text"
                                                                placeholder="Input Title..">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <div class="mb-3">
                                                        <label>Priority</label>
                                                        <select name="priority" class="form-select">
                                                            <option value="1">Low</option>
                                                            <option value="2">Medium</option>
                                                            <option value="3">High</option>
                                                            <option value="4">Urgent</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-sm-8">
                                                    <div class="mb-3">
                                                        <label>Deadline</label>
                                                        <div class="input-group">
                                                            <input class="form-control digits" type="text"
                                                                name="date_range" value=""
                                                                data-position="top left">
                                                            <input type="hidden" name="start_date">
                                                            <input type="hidden" name="end_date">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col">
                                                    <div class="mb-3">
                                                        <label>Description</label>
                                                        <textarea name="description" placeholder="Input Detail Project.." class="form-control" id="exampleFormControlTextarea4"
                                                            rows="3"></textarea>
                                                    </div>
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
