<div class="page-body">
    <div class="container-fluid">
        <div class="row">
            <div class="mt-4 col-12 col-sm-12">
                <div class="title">
                    <h3 class="pull-left">Page 404</h3>
                </div>
                <ol class="pull-right text-right breadcrumb">
                    <li class="breadcrumb-item">
                        <p><a href="{{ route('dashboard.index') }}" title="Home" data-bs-placement="bottom"><i data-feather="home"></i></a></p>
                    </li>
                    <li class="breadcrumb-parent breadcrumb-item">404</li>
                    <li class="breadcrumb-item active">Not Found</li>
                </ol>
            </div>
        </div>
        @include('pages.error.404.content.svg')
    </div>
    <div class="container-fluid">
        <div class="row"> 
        </div>
    </div>
</div>
