<div class="mt-4 col-12 col-sm-12">
    <div class="title">
        <h3 class="pull-left">{{ $parent }}</h3>
    </div>
    @php
        if (Auth::user()->role_id == 1) {
            $dashboard = route('dashboard.index');
        } elseif (Auth::user()->role_id == 2) {
            $dashboard = route('dashboard.member');
        }
    @endphp
    <ol class="pull-right text-right breadcrumb">
        <li class="breadcrumb-item">
            <p><a href="{{ $dashboard }}" title="Home" data-bs-placement="bottom"><i data-feather="home"></i></a></p>
        </li>
        <li class="breadcrumb-parent breadcrumb-item">{{ $parent }}</li>
        <li class="breadcrumb-item active">{{ $child }}</li>
    </ol>
</div>
