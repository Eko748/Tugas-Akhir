<div class="page-body">
    <div class="container-fluid default-dash">
        <div class="row">
            @include('layout.breadcrumb')
            <div class="col-sm-12">
                <div class="card b-l-primary b-t-primary border-3 card-absolute">
                    <div class="card-header bg-grey b-l-primary b-r-primary border-3">
                        <h5 style="display: inline">Pesan untuk pengguna {{ $child }}</h5>
                    </div>
                    <div class="tabbed-card me-3 pe-4 col-xl-12 mt-4 col-md-12">
                    </div>
                    {{-- <div id="messages">
                        @foreach ($messages as $message)
                            <p>{{ $message->message }}</p>
                        @endforeach
                    </div> --}}
                    <div class="card-body">
                        @include('pages.chat.content.components.firebase')
                        <!-- messages.blade.php -->
                        {{-- <div id="data-chat">
                            @include('pages.chat.content.components.data')
                        </div>      --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
