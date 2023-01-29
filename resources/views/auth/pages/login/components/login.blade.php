<!-- Loader starts-->
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
<!-- Loader ends-->
<!-- page-wrapper Start-->
<div class="container-fluid p-0">
  <div class="row m-0">
    <div class="col-xl-5 p-0"><img class="bg-img-cover bg-center" src="{{ asset('assets/images/login/3.jpg') }}"
        alt="looginpage"></div>
    <div class="col-xl-7 p-0">
      <div class="login-card">
        <!-- Session Status -->  
        <form class="theme-form login-form needs-validation" method="POST" action="{{ route('login') }}" novalidate="">
            @csrf
            <h4>Login</h4>
            <h6>Welcome back! Log in to your account.</h6>

            <!-- Email Address -->
            <div class="form-group">
                <x-input-label for="email" :value="__('Email')" />
            <div class="input-group"><span class="input-group-text"><i class="icon-email"></i></span>
                <x-text-input id="email" class="form-control block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                <div class="invalid-tooltip">Please enter proper email.</div>
            </div>
            </div>

            <!-- Password -->
            <div class="form-group">
                <x-input-label for="password" :value="__('Password')" />
            <div class="input-group"><span class="input-group-text"><i class="icon-lock"></i></span>
                <x-text-input id="password" class="form-control block mt-1 w-full"
                  type="password"
                  name="password"
                  required autocomplete="current-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
                <div class="invalid-tooltip">Please enter password.</div>
            </div>
            </div>

            {{-- <!-- Remember Me -->
            <div class="form-group">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600" name="remember">
                <x-input-label for="remember_me" :value="__('Remember me')" />
            </div> --}}
            {{-- <div class="form-group">
              <div class="checkbox">
                <input id="checkbox1" type="checkbox">
                <label class="text-muted" for="checkbox1">Remember password</label>
              </div>
            </div> --}}

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif

                <x-primary-button class="ml-3 btn btn-primary btn-block">
                    {{ __('Log in') }}
                </x-primary-button>
            </div>

            <div class="login-social-title">
              <h5>Sign up with</h5>
            </div>
            
            <div class="form-group">
              <a class="btn btn-danger" href="/auth/google">google</a>
              {{-- <ul class="login-social">
                <li><a href="https://www.linkedin.com/login" target="_blank"><i data-feather="linkedin"></i></a></li>
              </ul> --}}
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
      // Fetch all the forms we want to apply custom Bootstrap validation styles to
      var forms = document.getElementsByClassName('needs-validation');
      // Loop over them and prevent submission
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