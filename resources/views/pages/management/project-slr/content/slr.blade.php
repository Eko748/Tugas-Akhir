<div class="page-body">
    <div class="container-fluid">
        <div class="row">
            @include('layout.breadcrumb')
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <a href="{{ route('management.project.export', $uuid_project) }}" title="Export Project"
                                class="mt-4 ms-2 btn btn-secondary btn-sm pull-right btn-outline-dark hovering shadow-sm">
                                <i class="fa fa-file-excel-o"></i></a>
            @include('pages.management.project-slr.content.components.2-data-table')
        </div>
    </div>
</div>
