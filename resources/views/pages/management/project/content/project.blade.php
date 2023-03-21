<div class="page-body">
    <div class="container-fluid">
        <div class="row">
            @include('layout.breadcrumb')
        </div>
    </div>

    <div class="container-fluid">
        <div class="row project-cards">
            @include('pages.management.project.content.components.1-menu')
            <div class="col-sm-12">
                <div class="card">
                    {{-- <div class="card-header">
                        <a href="#" class="review-go pull-left">Review</a>
                    </div> --}}
                    <div class="card-body">
                        <div class="tab-content" id="top-tabContent">
                            <div id="project-load">
                                @include('pages.management.project.content.components.2-data')
                            </div>
                            <div id="doing-load" style="display: none;">
                                @include('pages.management.project.content.components.3-data-doing')
                            </div>
                            <div id="done-load" style="display: none;">
                                @include('pages.management.project.content.components.4-data-done')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @include('pages.management.project.content.components.5-modal-create')
        </div>
    </div>
</div>
