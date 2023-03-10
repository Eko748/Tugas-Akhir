<div class="page-body">
    <div class="container-fluid default-dash">
        <div class="row">
            @include('layout.breadcrumb')
            <div class="col-sm-12">
                <div class="card b-l-primary b-t-primary border-3 card-absolute">
                    <div class="card-header bg-grey b-l-primary b-r-primary border-3">
                        <h5 style="display: inline">Tabel Member</h5>
                    </div>
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif
                    <div class="card-body">
                        @include('pages.management.member.content.components.table')
                        @include('pages.management.member.content.components.create-modal')
                        @include('pages.management.member.content.components.update-modal')
                        @include('pages.management.member.content.components.institute-modal')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
