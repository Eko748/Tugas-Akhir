<div class="page-body">
    <div class="container-fluid">
        <div class="row">
            @include('layout.breadcrumb')
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card b-l-primary b-t-primary border-3 card-absolute">
                    <div class="card-header bg-grey b-l-primary b-r-primary border-3">
                        <h5 style="display: inline">{{ $child }}</h5>
                    </div>
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif
                    <div class="card-body">
                        @include('pages.management.member.content.components.1-data-table')
                        @include('pages.management.member.content.components.2-create-member')
                        @include('pages.management.member.content.components.3-update-member')
                        @include('pages.management.institute.1-modal-create')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

