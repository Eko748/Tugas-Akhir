<div class="page-body">
    @include('layout.breadcrumb')
    <div class="container-fluid default-dash">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <h5 style="display: inline">Tabel Karyawan</h5>
                        @if ($store == null)
                        <button class="btn btn-primary btn-sm pull-right" onclick="addStore()" data-bs-toggle="modal"  data-bs-target="#toko" id="createStore">
                            Create Toko
                        </button>
                        @else                            
                            <button title="Tambah Karyawan" class="btn btn-primary btn-sm pull-right btn-outline-light hovering shadow-sm" onclick="addEmployee()" data-bs-toggle="modal"
                            data-bs-target="#employee" id="createEmployee"><i class="fa fa-plus"></i></button>
                        @endif
                    </div>
                    @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        <p>{{ $message }}</p>
                    </div>
                    @endif
                    <div class="card-body">
                        {{-- <div class="form-group">
                            <div class="input-group">
                            <select id="data-employee" class="user form-select"></select>
                            </div>
                            </div> --}}
                        @include('admin.pages.management.employee.components.table')
                        @include('admin.pages.management.employee.components.create-modal')
                        @include('admin.pages.management.employee.components.update-modal')
                        @include('admin.pages.management.employee.components.store-modal')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>