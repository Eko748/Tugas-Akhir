<div class="page-body">
    <div class="container-fluid default-dash">
        <div class="row">
            @include('layout.breadcrumb')
            <div class="row">
                <div class="container-fluid">
                    <div class="edit-profile">
                        <div class="row">
                            <div class="col-xl-5 col-md-5 col-sm-5">
                                <div class="row">
                                    <div class="card">
                                        <div class="card-header pb-0">
                                            <h5 class="card-title mb-0">My Profile</h5>
                                            @if (session('status') === 'profile-updated')
                                                <i class="text-success fa fa-check"></i>
                                                <strong x-data="{ show: true }" x-show="show" x-transition
                                                    x-init="setTimeout(() => { show = false }, 2000)" x-bind:show="show"
                                                    class="text-sm text-success">
                                                    {{ __('Tersimpan') }}
                                                </strong>
                                            @endif
                                            <div class="card-options"><a class="card-options-collapse" href="#"
                                                    data-bs-toggle="card-collapse"><i
                                                        class="fe fe-chevron-up"></i></a><a class="card-options-remove"
                                                    href="#" data-bs-toggle="card-remove"><i
                                                        class="fe fe-x"></i></a></div>
                                        </div>
                                        <div class="card-body">
                                            @include('pages.profile.content.components.1-update-profile')
                                        </div>
                                    </div>
                                </div>
                                @if (Auth::user()->role_id == 1)
                                    <div class="row">
                                        <div class="card">
                                            <div class="card-header pb-0">
                                                <h5 class="card-title mb-0">Delete Account</h5>
                                                <div class="card-options"><a class="card-options-collapse"
                                                        href="#" data-bs-toggle="card-collapse"><i
                                                            class="fe fe-chevron-up"></i></a><a
                                                        class="card-options-remove" href="#"
                                                        data-bs-toggle="card-remove"><i class="fe fe-x"></i></a></div>
                                            </div>
                                            <div class="card-body">
                                                @include('pages.profile.content.components.3-delete-user')
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                            <div class="col-xl-7 col-md-7 col-sm-7">
                                <div class="card">
                                    <div class="card-header pb-0">
                                        <h5 class="card-title mb-0">Update Password</h5>
                                        @if (session('status') === 'password-updated')
                                            <i class="text-success fa fa-check"></i> <strong x-data="{ show: true }"
                                                x-show="show" x-transition x-init="setTimeout(() => show = false, 200)"
                                                class="text-sm text-success dark:text-gray-400">
                                                {{ __('Tersimpan') }}</strong>
                                        @endif
                                        <div class="card-options"><a class="card-options-collapse" href="#"
                                                data-bs-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a><a
                                                class="card-options-remove" href="#"
                                                data-bs-toggle="card-remove"><i class="fe fe-x"></i></a></div>
                                    </div>
                                    <div class="card-body">
                                        @include('pages.profile.content.components.2-update-password')
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
