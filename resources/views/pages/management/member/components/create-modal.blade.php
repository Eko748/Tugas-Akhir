{{-- <div class="modal fade" id="member" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div>
            <button class="btn-close theme-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            <form id="formCreateMember" class="" method="POST" action=""
                novalidate="">
                @csrf
                <div class="modal-body">
                    <div class="card">
                        <div class="animate-widget">
                            <div class="form-group">
                                <x-input-label for="name" :value="__('Name')" />
                                <div class="input-group"><span class="input-group-text"><i class="icon-user"></i></span>
                                    <x-text-input id="name" class="form-control" type="text" name="name"
                                        :value="old('name')" required autofocus />
                                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                    <div class="invalid-tooltip">Please enter name</div>
                                </div>
                            </div>

                            <!-- Email Address -->
                            <div class="form-group">
                                <x-input-label for="email" :value="__('Email')" />
                                <div class="input-group"><span class="input-group-text"><i
                                            class="icon-email"></i></span>
                                    <x-text-input id="email" class="form-control" type="email" name="email"
                                        :value="old('email')" required />
                                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                    <div class="invalid-tooltip">Please enter proper email</div>
                                </div>
                            </div>

                            <!-- Password -->
                            <div class="form-group">
                                <x-input-label for="password" :value="__('Password')" />
                                <div class="input-group"><span class="input-group-text"><i class="icon-lock"></i></span>
                                    <x-text-input id="password" class="form-control" type="password" name="password"
                                        required autocomplete="new-password" />
                                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                    <div class="invalid-tooltip">Please enter password</div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="checkbox">
                                    <div class="input-group">
                                        <x-text-input id="status"
                                            class="form-control rounded border-gray-300 text-indigo-600" value="1"
                                            type="checkbox" name="status" required />
                                        <x-input-error :messages="$errors->get('status')" class="mt-2" />
                                        <x-input-label for="status" :value="__('Agree with Privacy Policy')" />
                                        <div class="invalid-tooltip">Please agree this checkbox</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="ml-3 btn btn-load btn-primary btn-block">
                                Submit
                            </button>
                        </div>
                    </div>
                </div>
        </div>
        </form>
    </div>
</div>
</div> --}}

<div class="modal fade" id="member" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalHeadingMember"></h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="formCreateMember" class="theme-form needs-validation" method="POST" action=""
                novalidate="">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <x-input-label for="name" :value="__('Name')" />
                        <div class="input-group"><span class="input-group-text"><i class="icon-user"></i></span>
                            <x-text-input id="name" class="form-control" type="text" name="name"
                                :value="old('name')" required autofocus />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                            <div class="invalid-tooltip">Please enter name</div>
                        </div>
                    </div>

                    <!-- Email Address -->
                    <div class="form-group">
                        <x-input-label for="email" :value="__('Email')" />
                        <div class="input-group"><span class="input-group-text"><i class="icon-email"></i></span>
                            <x-text-input id="email" class="form-control" type="email" name="email"
                                :value="old('email')" required />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                            <div class="invalid-tooltip">Please enter proper email</div>
                        </div>
                    </div>

                    <!-- Password -->
                    <div class="form-group">
                        <x-input-label for="password" :value="__('Password')" />
                        <div class="input-group"><span class="input-group-text"><i class="icon-lock"></i></span>
                            <x-text-input id="password" class="form-control" type="password" name="password"
                                required autocomplete="new-password" />
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                            <div class="invalid-tooltip">Please enter password</div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="checkbox">
                            <div class="input-group">
                                <x-text-input id="status"
                                    class="form-control rounded border-gray-300 text-indigo-600" value="1"
                                    type="checkbox" name="status" required />
                                <x-input-error :messages="$errors->get('status')" class="mt-2" />
                                <x-input-label for="status" :value="__('Agree with Privacy Policy')" />
                                <div class="invalid-tooltip">Please agree this checkbox</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="ml-3 btn btn-load btn-primary btn-block">
                        Submit
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
