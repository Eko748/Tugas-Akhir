<div class="page-body">
    <div class="container-fluid">
        <div class="row">
            @include('layout.breadcrumb')
        </div>
    </div>

    <div class="container-fluid">
        <div class="row project-cards">
            @include('pages.management.project.content.components.1-menu')
            <div id="project-load">
                @include('pages.management.project.content.components.2-data')
            </div>
            @include('pages.management.project.content.components.3-modal-create')
        </div>
    </div>
</div>
