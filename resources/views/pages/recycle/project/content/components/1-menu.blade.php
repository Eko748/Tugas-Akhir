<div class="col-xl-3 box-col-3 xl-30">
    <div class="card">
        <div class="card-body">
            <div class="email-app-sidebar left-bookmark">
                <form action="">
                    <select name="uuid_project" id="search-input">
                        @foreach($projects as $key)
                        <option value="{{ $key['title'] }}">{{ $key['title'] }}</option>
                        @endforeach
                    </select>
                </form>
            </div>
        </div>
    </div>
</div>
