<div class="col-sm-12">
    <div class="card b-l-primary b-t-primary border-3 card-absolute">
        <div class="card-header bg-grey b-l-primary b-r-primary border-3">
            <h5 style="display: inline">List Data {{ $child }}</h5>
        </div>
        <div class="card-body">
            <div class="mb-4 mt-2">
                <button class="btn btn-success me-1 ms-1 btn-sm button text-white btn-outline-dark hovering shadow-sm"
                    title="Export PDF" data-bs-toggle="modal" data-bs-target="#viewPdf">
                    <i class="fa fa-file-pdf-o"></i> Export PDF
                </button>
                <button onclick="exportData()" title="Export Excel"
                    class="btn btn-success me-1 ms-1 btn-sm button text-white btn-outline-dark hovering shadow-sm">
                    <i class="fa fa-file-excel-o"></i> Export Excel
                </button>
                <h3 class="pull-right">Subject: <span>{{ $subject->subject }}</span></h3>
            </div>

            @include('pages.management.project.content.components.6-modal-pdf')
            @include('pages.management.project.content.components.7-modal-subject')

            <div class="table-responsive custom-scrollbar mb-1">
                <table class="table-project dataTable project table-hover table" id="table-project">
                    <thead class="table-primary">
                        <tr>
                            <th class="align-baseline text-center">No</th>
                            <th class="align-baseline">Code</th>
                            <th class="align-baseline">Title</th>
                            <th class="align-baseline">Abstract</th>
                            <th class="align-baseline">Year</th>
                            <th class="align-baseline">Authors</th>
                            <th class="align-baseline">Created Info</th>
                            <th class="align-baseline text-center">Action</th>
                        </tr>
                    </thead>
                </table>
                @include('pages.management.project.content.components.3-modal-view')
            </div>
        </div>
    </div>
</div>
