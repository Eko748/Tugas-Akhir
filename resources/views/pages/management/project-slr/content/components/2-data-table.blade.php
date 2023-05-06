<div class="col-sm-12">
    <div class="card b-l-primary b-t-primary border-3 card-absolute">
        <div class="card-header bg-grey b-l-primary b-r-primary border-3">
            <h5 style="display: inline">{{ $child }}</h5>
        </div>
        <div class="card-body">
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
                            <th class="align-baseline text-center">
                                <i class="fa fa-tags"></i>
                            </th>
                        </tr>
                    </thead>
                </table>
                @include('pages.management.project-slr.content.components.3-modal-view')
            </div>
        </div>
    </div>
</div>
