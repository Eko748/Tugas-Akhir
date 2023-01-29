<div class="container-fluid">
  <div class="page-title">
    <div class="row">
      <div class="col-12 col-sm-6">
        <h3>{{ $parent }}</h3>
      </div>
      <div class="col-12 col-sm-6">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="/"> <i data-feather="home"></i></a></li>
          <li class="breadcrumb-item">{{ $parent }}</li>
          <li class="breadcrumb-item active">{{ $child }}</li>
        </ol>
      </div>
    </div>
  </div>
</div>