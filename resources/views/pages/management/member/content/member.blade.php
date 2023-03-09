<div class="page-body">
    <div class="container-fluid default-dash">
        <div class="row">
            @include('layout.breadcrumb')
            <div class="col-sm-12">
                <div class="card b-l-primary b-t-primary border-3 card-absolute">
                    <div class="card-header bg-grey b-l-primary b-r-primary border-3">
                        <h5 style="display: inline">Tabel Member</h5>
                    </div>
                    <div class="ms-3 ps-4 me-5 pe-5 mt-4 tabbed-card col-xl-12 col-md-12">
                        @if ($institute == null)
                            <button class="btn btn-primary btn-sm pull-right" onclick="addInstitute()"
                                data-bs-toggle="modal" data-bs-target="#institute" id="createInstitute">
                                Create Institute
                            </button>
                        @else
                            <a href="{{ route('management.member.export') }}" title="Export Member"
                                class="mt-4 ms-2 btn btn-secondary btn-sm pull-right btn-outline-dark hovering shadow-sm">
                                <i class="fa fa-save"></i></a>
                            <button title="Create Member"
                                class="mt-4 me-2 btn btn-primary btn-sm pull-right btn-outline-dark hovering shadow-sm"
                                onclick="addMember()" data-bs-toggle="modal" data-bs-target="#member"
                                id="createMember"><i class="fa fa-plus-circle"></i></button>
                        @endif
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
