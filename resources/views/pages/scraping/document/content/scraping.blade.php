<div class="page-body">
    <div class="container-fluid">
        <div class="row">
            @include('layout.breadcrumb')
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            {{-- @foreach ($items as $ite)
            <p>{{$ite}}</p>
            @endforeach --}}
            
            @include('pages.scraping.document.content.components.card')
            @include('pages.scraping.document.content.components.create-category')
            @include('pages.scraping.document.content.components.info')
        </div>
    </div>
</div>
