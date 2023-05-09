<div class="loader-wrapper">
    <div class="loader">
        <div class="loader-bar"></div>
        <div class="loader-bar"></div>
        <div class="loader-bar"></div>
        <div class="loader-bar"></div>
        <div class="loader-bar"></div>
        <div class="loader-ball"></div>
    </div>
</div>
<div class="container-fluid p-0">
    <div class="row m-0">
        <div class="col-xl-5 col-md-5 p-0"
            style="background-color: transparent; display:flex; justify-content: center; align-items: center">
            <img class="bg-center ms-3 me-3" style="background-size:cover; width:90%;"
                src="{{ asset('assets/images/logo/slr.png') }}" alt="looginpage">
        </div>
        <div class="col-xl-7 col-md-7 p-0">
            <div class="login-card">
                <form class="theme-form login-form needs-validation" method="POST" action="{{ route('login') }}"
                    novalidate="">
                    @csrf
                    <h4 class="text-dark mb-3">Login</h4>
                    <div class="form-group">
                        <x-input-label class="text-dark" for="email" :value="__('Email')" />
                        <div class="input-group"><span class="input-group-text"><i class="icon-email"></i></span>
                            <x-text-input id="email" class="form-control block mt-1 w-full" type="email"
                                name="email" :value="old('email')" required autofocus />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                            <div class="invalid-tooltip">Please enter proper email.</div>
                        </div>
                    </div>
                    <div class="form-group">
                        <x-input-label class="text-dark" for="password" :value="__('Password')" />
                        <div class="input-group"><span class="input-group-text"><i class="icon-lock"></i></span>
                            <x-text-input id="password" class="form-control block mt-1 w-full" type="password"
                                name="password" required autocomplete="current-password" />
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                            <div class="invalid-tooltip">Please enter password.</div>
                        </div>
                    </div>
                    <div class="flex items-center justify-end mt-4">
                        <x-primary-button class="ml-3 btn btn-sm btn-primary btn-block btn-outline-dark">
                          <i class="fa fa-sign-in"></i> {{ __('Log in') }}
                        </x-primary-button>
                    </div>
                    <div class="login-social-title">
                        <h5>Sign up with</h5>
                    </div>
                    <div class="form-group d-flex justify-content-center align-items-center"
                        style="height: 60px; position: relative;">
                        <a class="text-center rounded-circle btn-outline-dark"
                            style="background-color: #F2F2F2; width: 50px; height: 50px; position: absolute; left: 50%; transform: translateX(-50%);"
                            href="{{ route('auth.google', ['provider' => 'google']) }}">
                            <img class="mt-2" style="width: 30px;"
                                src="{{ asset('assets/images/logo/google.png') }}" alt="">
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    (function() {
        'use strict';
        window.addEventListener('load', function() {
            let forms = document.getElementsByClassName('needs-validation');
            let validation = Array.prototype.filter.call(forms, function(form) {
                form.addEventListener('submit', function(event) {
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
