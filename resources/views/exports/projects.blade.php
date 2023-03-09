<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/bootstrap.css') }}" />

<table class="table-primary">
    <thead class="table-primary">
        <tr>
            <th style="text-align: center; vertical-align: middle; background-color:aqua;"><b>Category</b></th>
            <th style="text-align: center; vertical-align: middle; background-color:aqua;"><b>CODE</b></th>
            <th style="text-align: center; vertical-align: middle; background-color:aqua;"><b>Title</b></th>
            <th style="text-align: center; vertical-align: middle; background-color:aqua;"><b>Publisher</b></th>
            <th style="text-align: center; vertical-align: middle; background-color:aqua;"><b>Publication</b></th>
            <th style="text-align: center; vertical-align: middle; background-color:aqua;"><b>Year</b></th>
            <th style="text-align: center; vertical-align: middle; background-color:aqua;"><b>Type</b></th>
            <th style="text-align: center; vertical-align: middle; background-color:aqua;"><b>Cited</b></th>
            <th style="text-align: center; vertical-align: middle; background-color:aqua;"><b>Authors</b></th>
            <th style="text-align: center; vertical-align: middle; background-color:aqua;"><b>Abstracts</b></th>
            <th style="text-align: center; vertical-align: middle; background-color:aqua;"><b>Keywords</b></th>
            <th style="text-align: center; vertical-align: middle; background-color:aqua;"><b>References</b></th>
            <th style="text-align: center; vertical-align: middle; background-color:aqua;"><b>Created At</b></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($projects as $project)
            <tr>
                <td>{{ $project->getCategory->category_name }}</td>
                <td>{{ $project->code }}</td>
                <td>{{ $project->title }}</td>
                <td>{{ $project->publisher }}</td>
                <td>{{ $project->publication }}</td>
                <td>{{ $project->year }}</td>
                <td>{{ $project->type }}</td>
                <td>{{ $project->cited }}</td>
                <td>{{ $project->authors }}</td>
                <td>{{ $project->abstracts }}</td>
                <td>{{ $project->keywords }}</td>
                <td>{{ $project->references }}</td>
                <td>{{ $project->created_at }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

<script src="{{ asset('assets/js/bootstrap/bootstrap.bundle.min.js') }}"></script>
