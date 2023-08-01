<div class="modal fade" id="viewSubject" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenter"
    aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="pdf">
                    <i class="fa fa-folder-open"></i>
                    <strong id="modalHeadingViewSubject"> Update Subject</strong>
                </h5>
                <button class="btn-close btn-outline-danger" type="button" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('management.project.update') }}" method="post">
                            @csrf
                            @method('put')
                            <div class="row g-2">
                                <div class="mb-3 col-md-12"> <label for="sort_by">Subject Project</label>
                                    <input id="subject-project" placeholder="{{ $subject->subject }}"
                                        value="{{ $subject->subject }}" name="subject" class="form-control subject"
                                        style="width: 100%;">
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
