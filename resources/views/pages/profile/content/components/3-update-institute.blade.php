<section class="space-y-6">
    <x-danger-button class="btn btn-info btn-sm btn-outline-dark" data-bs-toggle="modal" data-bs-target="#institute">
        <i class="fa fa-edit"></i> {{ __('Update') }}
    </x-danger-button>

    <div class="modal fade" id="institute" aria-hidden="true" tabindex="-1" role="dialog" aria-labelledby="">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="fa fa-edit"></i> Update Institute<strong
                            id="modalHeadingCreateMember"></strong></h5>
                    <button class="btn-close btn-outline-danger" type="button" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <form method="post" action="{{ route('institute.update') }}" class="p-6">
                    @csrf
                    @method('put')
                    <div class="modal-body">
                        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                            {{ __('Apakah anda yakin?') }}
                        </h2>

                        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                            {{ __('Memperbarui nama instansi dapat mengubah indeks awal username pada semua akun anggota anda') }}
                        </p>

                        <div class="form-group mt-6 mb-4">
                            <x-input-label for="ins" value="{{ __('Nama Instansi Baru') }}" class="form-label" />
                            <div class="input-group"><span class="input-group-text"><i class="icon-home"></i></span>
                                <x-text-input id="ins" name="institute" type="text" class="form-control"
                                    placeholder="{{ __('Nama Instansi Baru') }}" value="{{ $user->hasInstitute->institute_name }}" />
                            </div>
                            <small>
                                <x-input-error class="text-danger mt-2" :messages="$errors->get('institute')" />
                            </small>
                        </div>

                        <div class="form-group mt-6 mb-5">
                            <x-input-label for="pass" value="{{ __('Konfirmasi Password') }}" class="form-label" />
                            <div class="input-group"><span class="input-group-text"><i class="icon-lock"></i></span>
                                <x-text-input id="pass" name="password" type="password" class="form-control"
                                    placeholder="{{ __('Konfirmasi Password') }}" />
                            </div>
                            <small>
                                <x-input-error class="text-danger mt-2" :messages="$errors->userDeletion->get('password')" />
                            </small>
                        </div>

                        <div class="mt-6 flex justify-end">
                            <x-secondary-button class="btn btn-xs btn-warning btn-outline-dark"
                                x-on:click="$dispatch('close')" type="button" data-bs-dismiss="modal">
                                <i class="fa fa-times-circle"></i> {{ __('Cancel') }}
                            </x-secondary-button>
                            <x-danger-button type="submit" class="btn btn-xs btn-success btn-outline-dark ml-3">
                                <i class="fa fa-save"></i> {{ __('Update') }}
                            </x-danger-button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
