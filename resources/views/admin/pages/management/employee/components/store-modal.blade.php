<div class="modal fade" id="toko" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalHeadingToko"></h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="formCreateToko" class="theme-form needs-validation" method="POST" action="" novalidate="">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <x-input-label for="store_name" :value="__('Name')"></x-input-label>
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="icon-user"></i>
                            </span>
                            <x-text-input id="store_name" class="form-control" type="text" name="store_name" :value="old('store_name')" required autofocus></x-text-input>
                            <x-input-error :messages="$errors->get('store_name')" class="mt-2">
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
