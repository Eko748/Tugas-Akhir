<div class="mt-3 col-12 col-sm-12">
    <h3 class="pull-left">{{ $parent }}</h3>
    <ol class="pull-right text-right breadcrumb">
        <li class="breadcrumb-item"><h6><a href="/"><i data-feather="home"></i></a></h6></li>
        <li class="breadcrumb-item">{{ $parent }}</li>
        <li class="breadcrumb-item active">{{ $child }}</li>
    </ol>
</div>