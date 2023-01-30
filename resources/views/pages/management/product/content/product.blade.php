<div class="page-body">
    <!-- Container-fluid starts-->
    <div class="container-fluid default-dash">
        <div class="row">
            @include('layout.breadcrumb')
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <div class="container-fluid row">
                            <div class="row g-3">
                                <div class="mb-3 col-md-4">
                                    <input name="search" id="search" class="form-control" placeholder="Search....">
                                </div>
                                <div class="mb-3 col-md-4">
                                    <select name="product" id="select" class="users_select form-control">
                                        @foreach ($search as $key)
                                            @php
                                                $user = App\Models\User::all();
                                            @endphp
                                            <option value="{{ $key->name }}">{{ $key->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        {{-- @include('inc.search') --}}
                        {{-- @include('inc.filter') --}}
                        {{-- @include('inc.filter') --}}
                        {{-- <div class="container-fluid user-card">
                            <div id="load" class="row">
                                <div class="user_data"></div>
                                {{ $users->links() }}
                            </div>
                        </div> --}}

                        {{-- <div class="container-fluid col-md-3 mb-3 row">
                            <div class="form-group">
                                <input name="search" id="search" class="form-control" placeholder="Search....">
                                <select name="product" id="select" class="pull-right users_select form-control">
                                    @foreach ($search as $key)
                                        @php
                                            $user = App\Models\User::all();
                                        @endphp
                                        <option value="{{ $key->name }}">{{ $key->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div> --}}
                        {{-- <option value='0'>- Search User -</option> --}}
                        <div id="user_data">
                            @include('pages.management.product.components.pagination_data')
                        </div>
                        @foreach ($companies as $company => $c)
                            {{ $c['html'] }}
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Container-fluid Ends-->
</div>
