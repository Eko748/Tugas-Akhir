<div class="page-body">
    <div class="container-fluid default-dash">
        <div class="row">
            @include('layout.breadcrumb')
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xl-6 col-md-6 col-sm-6">
                        <div class="row">
                            <div class="col-md-12 col-sm-12">
                                <div class="card">
                                    <div class="card-header pb-0">
                                        <h5 class="card-title mb-0">My Profile @if (session('status') === 'profile-updated')
                                                <a href="{{ route('dashboard.index') }}"
                                                    class="btn btn-outline-primary btn-xs pull-right"><i
                                                        class="fa fa-home"></i> Back to Dashboard</a>
                                            @endif
                                        </h5>
                                        @if (session('status') === 'profile-updated')
                                            <div class="pull-right">
                                                <i class="text-success fa fa-check"></i>
                                                <strong x-data="{ show: true }" x-show="show" x-transition
                                                    x-init="setTimeout(() => { show = false }, 2000)" x-bind:show="show"
                                                    class="text-sm text-success">
                                                    {{ __('Tersimpan') }}
                                                </strong>
                                            </div>
                                        @endif
                                        <div class="card-options"><a class="card-options-collapse" href="#"
                                                data-bs-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a><a
                                                class="card-options-remove" href="#"
                                                data-bs-toggle="card-remove"><i class="fe fe-x"></i></a></div>
                                    </div>
                                    <div class="card-body">
                                        @include('pages.profile.content.components.1-update-profile')
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if (Auth::user()->role_id == 1)
                            <div class="row">
                                @if (Auth::user()->hasInstitute)
                                    <div class="col-md-6 col-sm-6 col-xs-6">
                                        <div class="card">
                                            <div class="card-header pb-0">
                                                <h6 class="card-title mb-3">Update Institute
                                                </h6>
                                                @if (session('status') === 'institute-updated')
                                                    <h6>
                                                        <a href="{{ route('dashboard.index') }}"
                                                        class="btn btn-outline-primary btn-xs"><i
                                                            class="fa fa-home"></i>
                                                        Back to Dashboard</a>
                                                    </h6>
                                                @endif
                                                <div class="card-options"><a class="card-options-collapse"
                                                        href="#" data-bs-toggle="card-collapse"><i
                                                            class="fe fe-chevron-up"></i></a><a
                                                        class="card-options-remove" href="#"
                                                        data-bs-toggle="card-remove"><i class="fe fe-x"></i></a>
                                                </div>
                                                @if (session('status') === 'institute-updated')
                                                    <div class="pull-left">
                                                        <i class="text-success fa fa-check"></i>
                                                        <strong x-data="{ show: true }" x-show="show" x-transition
                                                            x-init="setTimeout(() => { show = false }, 2000)" x-bind:show="show"
                                                            class="text-sm text-success">
                                                            {{ __('Tersimpan') }}
                                                        </strong>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="card-body">
                                                @include('pages.profile.content.components.3-update-institute')
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                <div class="col-md-6 col-sm-6 col-xs-6">
                                    <div class="card">
                                        <div class="card-header pb-0">
                                            <h6 class="card-title mb-3">Delete Account</h6>
                                            <div class="card-options"><a class="card-options-collapse" href="#"
                                                    data-bs-toggle="card-collapse"><i
                                                        class="fe fe-chevron-up"></i></a><a class="card-options-remove"
                                                    href="#" data-bs-toggle="card-remove"><i
                                                        class="fe fe-x"></i></a>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            @include('pages.profile.content.components.4-delete-user')
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="col-xl-6 col-md-6 col-sm-6">
                        <div class="card">
                            <div class="card-header pb-0">
                                <h5 class="card-title mb-0">Update Password
                                    @if (session('status') === 'password-updated')
                                        <a href="{{ route('dashboard.index') }}"
                                            class="btn btn-outline-primary btn-xs pull-right"><i class="fa fa-home"></i>
                                            Back to Dashboard</a>
                                    @endif
                                </h5>
                                @if (session('status') === 'password-updated')
                                    <div class="pull-right">
                                        <i class="text-success fa fa-check"></i> <strong x-data="{ show: true }"
                                            x-show="show" x-transition x-init="setTimeout(() => show = false, 200)"
                                            class="text-sm text-success dark:text-gray-400">
                                            {{ __('Tersimpan') }}</strong>
                                    </div>
                                @endif
                                <div class="card-options"><a class="card-options-collapse" href="#"
                                        data-bs-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a><a
                                        class="card-options-remove" href="#" data-bs-toggle="card-remove"><i
                                            class="fe fe-x"></i></a></div>
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
