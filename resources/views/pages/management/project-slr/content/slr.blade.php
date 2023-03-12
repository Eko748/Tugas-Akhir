<div class="page-body">
    <div class="container-fluid">
        <div class="row">
            @include('layout.breadcrumb')
        </div>
    </div>

    <div class="container-fluid">
        <h4 class="mb-3">{{ $title }}</h4>
        <div class="row">
            @include('pages.management.project-slr.content.components.2-data-table')
        </div>
    </div>
</div>
