<div class="loader-wrapper">
<<<<<<< HEAD
    <div class="loader">
        <div class="loader-bar"></div>
        <div class="loader-bar"></div>
        <div class="loader-bar"></div>
        <div class="loader-bar"></div>
        <div class="loader-bar"></div>
        <div class="loader-ball"></div>
=======
  <div class="loader">
    <div class="loader-bar"></div>
    <div class="loader-bar"></div>
    <div class="loader-bar"></div>
    <div class="loader-bar"></div>
    <div class="loader-bar"></div>
    <div class="loader-ball"></div>
  </div>
</div>
<!-- Loader ends-->
<!-- page-wrapper Start-->
<div class="container-fluid p-0">
    <div class="row m-0">
      <div class="col-xl-5 p-0"><img class="bg-img-cover bg-center" src="{{ asset('assets/images/login/3.jpg') }}"
          alt="looginpage"></div>
      <div class="col-xl-7 p-0">
        <div class="login-card">
          <form class="theme-form login-form needs-validation" method="POST" action="{{ route('management.employee.post') }}" novalidate="">
            @csrf

            <h4>Buat akun karyawanmu</h4>
            <h6>Enter your personal details to create account</h6>
            <!-- Name -->
            <div class="form-group">
                <x-input-label for="name" :value="__('Name')" />
                <div class="input-group"><span class="input-group-text"><i class="icon-email"></i></span>
                <x-text-input id="name" class="form-control block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
                <div class="invalid-tooltip">Please enter name</div>
                </div>
            </div>

            <!-- Email Address -->
             <div class="form-group">
                <x-input-label for="email" :value="__('Email')" />
                <div class="input-group"><span class="input-group-text"><i class="icon-email"></i></span>
                <x-text-input id="email" class="form-control block mt-1 w-full" type="email" name="email" :value="old('email')" required />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                <div class="invalid-tooltip">Please enter proper email</div>
                </div>
            </div>

            <!-- Password -->
             <div class="form-group">
                <x-input-label for="password" :value="__('Password')" />
                <div class="input-group"><span class="input-group-text"><i class="icon-email"></i></span>
                <x-text-input id="password" class="form-control block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
                <div class="invalid-tooltip">Please enter password</div>
                </div>
            </div>

            <!-- Confirm Password -->
            {{-- <div class="form-group">
                <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                <div class="input-group"><span class="input-group-text"><i class="icon-email"></i></span>
                <x-text-input id="password_confirmation" class="form-control block mt-1 w-full"
                                type="password"
                                name="password_confirmation" required />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                <div class="invalid-tooltip">Please enter proper email.</div>
                </div>
            </div> --}}

            <div class="form-group">
              <div class="checkbox">
                <div class="input-group">
                <x-text-input id="status" class="form-control rounded border-gray-300 text-indigo-600 block mt-1 w-full"
                                value="1" type="checkbox" name="status" required />
                <x-input-error :messages="$errors->get('status')" class="mt-2" />
                <x-input-label for="status" :value="__('Agree with Privacy Policy')" />
                <div class="invalid-tooltip">Please agree this checkbox</div>
                </div>
              </div>
            </div>
            <br>
            <div class="flex items-center justify-end mt-4">
                {{-- <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a> --}}
                <x-primary-button class="ml-3 btn btn-primary btn-block">
                    {{ __('Register') }}
                </x-primary-button>
            </div>
        </form>
        </div>
      </div>
    </div>
</div>

<div class="container-fluid p-0">
    <div class="row m-0">
        <div class="col-xl-5 p-0">
            <img class="bg-img-cover bg-center" src="{{ asset('assets/images/login/3.jpg') }}" alt="looginpage">
        </div>
        <div class="col-xl-7 p-0">
            <div class="login-card">
                <form class="theme-form login-form needs-validation" method="POST" action="{{ route('register') }}" novalidate="">
                    @csrf

                    <h4>Buat akun karyawanmu</h4>
                    <h6>Enter your personal details to create account</h6>
                    <div class="form-group">
                        <x-input-label for="name" :value="__('Name')">
                        </x-input-label>
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="icon-email"></i>
                            </span>
                            <x-text-input id="name" class="form-control block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus></x-text-input>
                            <x-input-error :messages="$errors->get('name')" class="mt-2"></x-input-error>
                            <div class="invalid-tooltip">
                                Please enter name
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <x-input-label for="email" :value="__('Email')"></x-input-label>
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="icon-email"></i>
                            </span>
                            <x-text-input id="email" class="form-control block mt-1 w-full" type="email" name="email" :value="old('email')" required></x-text-input>
                            <x-input-error :messages="$errors->get('email')" class="mt-2"></x-input-error>
                            <div class="invalid-tooltip">
                                Please enter proper email
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <x-input-label for="password" :value="__('Password')"></x-input-label>
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="icon-email"></i>
                            </span>
                            <x-text-input id="password" class="form-control block mt-1 w-full"
                            type="password"
                            name="password"
                            required  autocomplete="new-password"></x-text-input>
                            <x-input-error :messages="$errors->get('password')" class="mt-2"></x-input-error>
                            <div class="invalid-tooltip">
                                Please enter password
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="checkbox">
                            <div class="input-group">
                                <x-text-input id="status" class="form-control rounded border-gray-300 text-indigo-600 block mt-1 w-full"
                                value="1" type="checkbox" name="status" required></x-text-input>
                                <x-input-error :messages="$errors->get('status')" class="mt-2"></x-input-error>
                                <x-input-label for="status" :value="__('Agree with Privacy Policy')"></x-input-label>
                                <div class="invalid-tooltip">
                                    Please agree this checkbox
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="flex items-center justify-end mt-4">
                        <x-primary-button class="ml-3 btn btn-primary btn-block">
                            {{ __('Register') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    (function () {
        'use strict';
        window.addEventListener('load', function () {
            var forms = document.getElementsByClassName('needs-validation');
            var validation = Array.prototype.filter.call(forms, function (form) {
                form.addEventListener('submit', function (event) {
                    if (form.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        }, false);
    })();
</script>
