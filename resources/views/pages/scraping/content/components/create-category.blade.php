        <div class="col-xl-6 xl-100 col-lg-12 box-col-12">
            <div class="card b-r-primary border-3">
                <div class="card-header pb-0">
                    <h5 class="category" style="display: inline">Create</h5>
                </div>
                <div class="card-body">
                    <form id="formCreateInstitute" class="theme-form needs-validation" method="POST" action=""
                        novalidate="">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <x-input-label for="institute_name" :value="__('Nama Instansi')"></x-input-label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="icon-user"></i>
                                    </span>
                                    <x-text-input id="institute_name" class="form-control" type="text"
                                        name="institute_name" :value="old('institute_name')" required autofocus></x-text-input>
                                    <x-input-error :messages="$errors->get('institute_name')" class="mt-2">
                                        <div class="invalid-tooltip">
                                            Please enter name
                                        </div>
                                    </x-input-error>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-danger btn-sm" type="reset">
                                Batal
                            </button>
                            <button type="submit" class="btn btn-primary btn-sm">
                                Tambah
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
