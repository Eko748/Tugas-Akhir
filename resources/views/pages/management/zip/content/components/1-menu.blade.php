<div class="col-md-12 project-list">
    <div class="card">
        <div class="row">
            <div class="col-md-6 p-0 ps-3 text-center mt-2 mb-3">
                <ul class="nav nav-tabs border-tab" id="top-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="top-home-tab" data-bs-toggle="tab" href="#top-home" role="tab"
                            aria-controls="top-home" aria-selected="true">
                            <i data-feather="target"></i>
                            All
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="top-doing-tab" data-bs-toggle="tab" href="#top-doing" role="tab"
                            aria-controls="top-doing" aria-selected="false">
                            <i data-feather="info"></i>
                            Doing
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="top-done-tab" data-bs-toggle="tab" href="#top-done" role="tab"
                            aria-controls="top-done" aria-selected="false">
                            <i data-feather="check-circle"></i>
                            Done
                        </a>
                    </li>
                </ul>
            </div>
            @if (Auth::user()->role_id == 1)
                <div class="col-md-6 d-flex justify-content-center justify-content-md-end mt-2 mb-3">
                    <a title="Go to Review" href="{{ route('review.master.index') }}" class="btn-success review-go me-2 mr-auto button">Review</a>
                    <button title="Create Project" class="btn btn-primary review-go ms-2 ml-auto" onclick="addProject()"
                        data-bs-toggle="modal" data-bs-target="#project" id="createProject">
                        New Project
                    </button>
                </div>
            @endif
        </div>
    </div>
</div>
