<div class="modal fade" id="member" aria-hidden="true" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenter">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fa fa-plus"></i>  <strong id="modalHeadingCreateMember"></strong></h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="formCreateMember" class="theme-form needs-validation" method="POST" novalidate="">
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
                            <x-text-input id="password" class="form-control" type="password" name="password" required
                                autocomplete="new-password" />
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                            <div class="invalid-tooltip">Please enter password</div>
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
