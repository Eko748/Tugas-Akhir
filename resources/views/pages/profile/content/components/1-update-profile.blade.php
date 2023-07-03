<section>
    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')
        <div class="form-group mb-3">
            <x-input-label class="form-label" for="name" :value="__('Nama')" />
            <div class="input-group"><span class="input-group-text"><i class="icon-user"></i></span>
                <x-text-input id="name" name="name" type="text" class="form-control block w-full"
                    :value="old('name', $user->name)" required autofocus autocomplete="name" />
                <x-input-error class="text-danger mt-2" :messages="$errors->updateProfile->get('name')" />
            </div>
        </div>
        @if (Auth::user()->role_id == 1)
            <div class="form-group mb-3">
                <x-input-label class="form-label" for="username" :value="__('Username')" />
                <div class="input-group">
                    <span class="input-group-text"><i class="icon-user"></i></span>
                    <x-text-input id="username" name="username" type="text" class="form-control block w-full"
                        :value="old('username', $user->username)" required autocomplete="username" />
                </div>
                <x-input-error class="mt-2 text-danger" :messages="$errors->get('username')" />
            </div>
        @elseif (Auth::user()->role_id == 2)
            <div class="form-group mb-3">
                <x-input-label class="form-label" for="username" :value="__('Username')" />
                <div class="input-group">
                    <span class="input-group-text"><i class="icon-user"></i></span>
                    <x-text-input id="username" name="username" type="text" class="form-control block w-full"
                        :value="old('username', $user->username)" required autocomplete="username" />
                </div>
                <x-input-error class="mt-2 text-danger" :messages="$errors->get('username')" />
            </div>
        @endif
        <div class="flex items-center gap-4">
            <div class="row">
                <div class="col-md-6 col-sm-6">
                    <x-primary-button class="btn btn-xs btn-success btn-outline-dark"><i class="fa fa-save"></i>
                        {{ __('Submit') }}</x-primary-button>
                </div>
            </div>
        </div>
    </form>
</section>
