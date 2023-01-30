<div class="page-body">
    <div class="container-fluid default-dash">
        <div class="row">
            @include('layout.breadcrumb')
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <h5 style="display: inline">Tabel Member</h5>
                        @if ($institute == null)
                        <button class="btn btn-primary btn-sm pull-right" onclick="addInstitute()" data-bs-toggle="modal"  data-bs-target="#institute" id="createInstitute">
                            Create Institute
                        </button>
                        @else                            
                            <button title="Create Member" class="btn btn-primary btn-sm pull-right btn-outline-light hovering shadow-sm" onclick="addMember()" data-bs-toggle="modal"
                            data-bs-target="#member" id="createMember"><i class="class="feather feather-plus-square""></i></button>
                        @endif
                    </div>
                    @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        <p>{{ $message }}</p>
                    </div>
                    @endif
                    <div class="card-body">
                        @include('pages.management.member.components.table')
                        @include('pages.management.member.components.create-modal')
                        @include('pages.management.member.components.update-modal')
                        @include('pages.management.member.components.institute-modal')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>