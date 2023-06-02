<div class="col-sm-12 col-xl-6 box-col-6">
    @if (session('status') === 'new-user')
        <div class="row">
            <div class="col-xl-12 col-md-12 col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="alert alert-danger inverse alert-dismissible fade show mb-3" role="alert"><i
                                class="icon-alert"></i>
                            <span>Default <b>Password Anda </b>adalah <b>12345678 </b><br> Perbarui password, untuk
                                melindungi data anda</span>
                            <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        <a href="{{ route('profile.index') }}" class="btn btn-outline-primary btn-sm">Perbarui Sekarang <i class="icon-arrow-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="col-sm-12 col-xl-12 box-col-12">
            <div class="card">
                <div class="card-body">
                    <div id="chart-review"></div>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-xl-12 box-col-12">
            <div class="card">
                <div class="card-body">
                    <div id="chart-member"></div>
                </div>
            </div>
        </div>
    @endif
</div>
