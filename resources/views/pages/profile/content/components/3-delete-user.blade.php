<section class="space-y-6">
    <x-danger-button class="btn btn-danger btn-xs btn-outline-dark" data-bs-toggle="modal" data-bs-target="#delete">
        <i class="fa fa-warning"></i> {{ __('Delete Account') }}
    </x-danger-button>

    <div class="modal fade" id="delete" aria-hidden="true" tabindex="-1" role="dialog" aria-labelledby="">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="fa fa-warning"></i> Delete Account<strong
                            id="modalHeadingCreateMember"></strong></h5>
                    <button class="btn-close btn-outline-danger" type="button" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
                    @csrf
                    @method('delete')
                    <div class="modal-body">
                        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                            {{ __('Apakah anda yakin?') }}
                        </h2>

                        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                            {{ __('Menghapus akun akan menghilangkan semua data yang berkaitan dengan akun anda') }}
                        </p>

                        <div class="mt-6 mb-3">
                            <x-input-label for="password" value="{{ __('Password') }}" class="sr-only form-label" />

                            <x-text-input id="password" name="password" type="password"
                                class="form-control mt-1 block w-3/4" placeholder="{{ __('Password') }}" />

                            <x-input-error class="text-danger mt-2" :messages="$errors->userDeletion->get('password')" />
                        </div>

                        <div class="mt-6 flex justify-end">
                            <x-secondary-button class="btn bt-xs btn-warning btn-outline-dark"
                                x-on:click="$dispatch('close')">
                                <i class="fa fa-times-circle"></i> {{ __('Cancel') }}
                            </x-secondary-button>

                            <x-danger-button class="btn bt-xs btn-danger btn-outline-dark ml-3">
                                <i class="fa fa-warning"></i> {{ __('Delete') }}
                            </x-danger-button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
    </x-modal> --}}
</section>
