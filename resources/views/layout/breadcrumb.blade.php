<div class="mt-4 col-12 col-sm-12">
    <div class="title">
        <h3 class="pull-left">{{ $parent }}</h3>
    </div>
    <ol class="pull-right text-right breadcrumb">
        <li class="breadcrumb-item">
            <p><a href="/"><i data-feather="home"></i></a></p>
        </li>
        <li class="breadcrumb-parent breadcrumb-item">{{ $parent }}</li>
        <li class="breadcrumb-item active">{{ $child }}</li>
    </ol>
</div>
