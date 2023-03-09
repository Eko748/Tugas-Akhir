<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/bootstrap.css') }}" />

<table class="table-primary">
    <thead class="table-primary">
        <tr>
            <th style="text-align: center; vertical-align: middle; background-color:aqua;"><b>Code</b></th>
            <th style="text-align: center; vertical-align: middle; background-color:aqua;"><b>Nama</b></th>
            <th style="text-align: center; vertical-align: middle; background-color:aqua;"><b>Email</b></th>
            <th style="text-align: center; vertical-align: middle; background-color:aqua;"><b>Created At</b></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($users as $user)
            <tr>
                <td>{{ $user->code }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->created_at }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

<script src="{{ asset('assets/js/bootstrap/bootstrap.bundle.min.js') }}"></script>
