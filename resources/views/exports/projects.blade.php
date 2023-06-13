<!DOCTYPE html>

<head>
</head>

<body>
    <table>
        <tr>
            <th style="text-align: center; vertical-align: middle;"><b><br>No<br></b></th>
            <th style="text-align: center; vertical-align: middle;"><b>Code</b></th>
            <th style="text-align: center; vertical-align: middle;"><b>Title</b></th>
            <th style="text-align: center; vertical-align: middle;"><b>Publisher</b></th>
            <th style="text-align: center; vertical-align: middle;"><b>Publication</b></th>
            <th style="text-align: center; vertical-align: middle;"><b>Year</b></th>
            <th style="text-align: center; vertical-align: middle;"><b>Type</b></th>
            <th style="text-align: center; vertical-align: middle;"><b>Authors</b></th>
            <th style="text-align: center; vertical-align: middle;"><b>Abstract</b></th>
            <th style="text-align: center; vertical-align: middle;"><b>Keywords</b></th>
            <th style="text-align: center; vertical-align: middle;"><b>References</b></th>
            <th style="text-align: center; vertical-align: middle;"><b>Cited</b></th>
            <th style="text-align: center; vertical-align: middle;"><b>Citing</b></th>
            <th style="text-align: center; vertical-align: middle;"><b>Reference Source</b></th>
        </tr>
        @php
            $no = 1;
        @endphp
        @foreach ($projects as $project)
            <tr>
                <td style="text-align: center; vertical-align: middle;">{{ $no++ }}</td>
                <td>{{ $project->code }}</td>
                <td>{{ $project->title }}</td>
                <td>{{ $project->publisher }}</td>
                <td>{{ $project->publication }}</td>
                <td>{{ $project->year }}</td>
                <td>{{ $project->type }}</td>
                <td>{{ $project->authors }}</td>
                <td>{{ $project->abstracts }}</td>
                <td>{{ $project->keywords }}</td>
                <td>{{ $project->references }}</td>
                <td>{{ $project->cited }}</td>
                <td>
                    @if (!is_null($project->references))
                        @if (stripos($project->references, $project->title) !== true)
                            @php
                                $referencingProjects = $projects->filter(function ($referencingProject) use ($project) {
                                    return $referencingProject->title != null && stripos($project->references, $referencingProject->title) !== false;
                                });
                                $citingCodes = $referencingProjects
                                    ->pluck('code')
                                    ->unique()
                                    ->implode('; ');
                            @endphp
                            {{ $citingCodes }}
                        @endif
                    @endif
                </td>
                <td>{{ $project->reference_source == null ? '' : $project->reference_source }}</td>
            </tr>
        @endforeach
    </table>
</body>

</html>
