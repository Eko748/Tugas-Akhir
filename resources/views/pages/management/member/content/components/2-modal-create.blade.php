<div class="modal fade" id="member" aria-hidden="true" tabindex="-1" role="dialog" aria-labelledby="">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fa fa-plus-circle"></i> <strong id="modalHeadingCreateMember"></strong></h5>
                <button class="btn-close btn-outline-danger" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            @if ($institute['slug'] != null)
            <form id="formCreateMember" class="theme-form needs-validation" method="POST" novalidate="">
                @csrf
                <div class="modal-body mt-3">
                    <div class="form-group">
                        <label for="name">Nama <span class="text-danger">*</span></label>
                        <div class="input-group"><span class="input-group-text"><i class="icon-user"></i></span>
                            <x-text-input id="name" class="form-control" placeholder="Input Nama..." type="text" name="name"
                                :value="old('name')" required autofocus />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                            <div class="invalid-tooltip">Please enter name</div>
                        </div>
                    </div>

                    <!-- Email Address -->
                    <div class="form-group">
                        <label for="email">Email <span class="text-danger">*</span> <sup><i class="fa fa-question-circle hovering" title="Indeks tambahan Instansi: {{ $institute['slug'] }}"></i></sup></label>
                        <div class="input-group"><span class="input-group-text"><i class="icon-email"></i></span>
                            <x-text-input id="email" class="form-control" placeholder="Input Email..." type="email" name="email"
                                :value="old('email')" required />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                            <div class="invalid-tooltip">Please enter proper email</div>
                        </div>
                    </div>

                    <!-- Password -->
                    <div class="form-group">
                        <label for="password">Password <span class="text-danger">*</span></label>
                        <div class="input-group"><span class="input-group-text"><i class="icon-lock"></i></span>
                            <x-text-input id="password" class="form-control" placeholder="Input Password..." type="password" name="password" required
                                autocomplete="new-password" />
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                            <div class="invalid-tooltip">Please enter password</div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-sm btn-outline-dark text-white btn-danger" type="button"
                        data-bs-dismiss="modal">
                        <i class="fa fa-times-circle"></i> Close
                    </button>
                    <button type="submit" class="btn btn-sm btn-outline-dark text-white btn-success btn-block">
                        <i class="fa fa-save"></i> Simpan
                    </button>
                </div>
            </form>
            @endif
        </div>
    </div>
</div>
