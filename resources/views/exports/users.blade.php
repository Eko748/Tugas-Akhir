<table class="table table-striped">
    <thead>
        <tr>
            <th style="text-align: center; vertical-align: middle;"><b>Code</b></th>
            <th style="text-align: center; vertical-align: middle;"><b>Nama</b></th>
            <th style="text-align: center; vertical-align: middle;"><b>Email</b></th>
            <th style="text-align: center; vertical-align: middle;"><b>Created At</b></th>
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
