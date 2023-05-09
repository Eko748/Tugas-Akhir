<section>
    {{-- <div class="mb-3">
            <label class="form-label">Email-Address</label>
            <input class="form-control" placeholder="your-email@domain.com">
        </div> --}}
    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <div class="form-group mb-3">
            <x-input-label class="form-label" for="current_password" :value="__('Current Password')" />
            <div class="input-group"><span class="input-group-text"><i class="icon-lock"></i></span>
                <x-text-input class="form-control block w-full" id="current_password" name="current_password"
                    type="password" autocomplete="current-password" />
                <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
            </div>
        </div>

        <div class="form-group mb-3">
            <x-input-label class="form-label" for="password" :value="__('New Password')" />
            <div class="input-group"><span class="input-group-text"><i class="icon-lock"></i></span>
                <x-text-input class="form-control block w-full" id="password" name="password" type="password"
                    autocomplete="new-password" />
                <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
            </div>
        </div>

        <div class="form-group mb-3">
            <x-input-label class="form-label" for="password_confirmation" :value="__('Confirm Password')" />
            <div class="input-group"><span class="input-group-text"><i class="icon-lock"></i></span>
                <x-text-input class="form-control block w-full" id="password_confirmation"
                    name="password_confirmation" type="password" autocomplete="new-password" />
                <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
            </div>
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button class="btn btn-xs btn-success btn-outline-dark"><i class="fa fa-save"></i>
                {{ __('Save') }}</x-primary-button>

            @if (session('status') === 'password-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600 dark:text-gray-400">{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
