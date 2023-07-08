<section>
    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <div class="form-group mb-3">
            <x-input-label class="form-label" for="current_password" :value="__('Current Password')" />
            <div class="input-group"><span class="input-group-text"><i class="icon-lock"></i></span>
                <x-text-input class="form-control block w-full" id="current_password" name="current_password"
                    type="password" placeholder="Input password lama.." autocomplete="current-password" />
            </div>
            <small>
                <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2 text-danger" />
            </small>
        </div>

        <div class="form-group mb-3">
            <x-input-label class="form-label" for="password" :value="__('New Password')" />
            <div class="input-group"><span class="input-group-text"><i class="icon-lock"></i></span>
                <x-text-input class="form-control block w-full" id="password" name="password" type="password"
                placeholder="Password baru.." autocomplete="new-password" />
            </div>
            <small>
                <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2 text-danger text-xs" />
            </small>
        </div>

        <div class="form-group mb-3">
            <x-input-label class="form-label" for="password_confirmation" :value="__('Confirm Password')" />
            <div class="input-group"><span class="input-group-text"><i class="icon-lock"></i></span>
                <x-text-input class="form-control block w-full" id="password_confirmation" name="password_confirmation"
                    type="password" placeholder="Konfirmasi password baru.." autocomplete="new-password" />
            </div>
            <small>
                <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2 text-danger" />
            </small>
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button class="btn btn-xs btn-success btn-outline-dark"><i class="fa fa-save"></i>
                {{ __('Submit') }}</x-primary-button>
        </div>
    </form>
</section>
