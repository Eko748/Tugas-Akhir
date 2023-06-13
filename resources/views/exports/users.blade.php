<table class="table table-striped">
    <thead>
        <tr>
            <th style="text-align: center; vertical-align: middle;"><b>Code</b></th>
            <th style="text-align: center; vertical-align: middle;"><b>Nama</b></th>
            <th style="text-align: center; vertical-align: middle;"><b>Email</b></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($users as $user)
            <tr>
                <td style="text-align: center; vertical-align: middle;">{{ $user->code }}</td>
                <td style="text-align: center; vertical-align: middle;">{{ $user->name }}</td>
                <td style="text-align: center; vertical-align: middle;">{{ $user->email }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
