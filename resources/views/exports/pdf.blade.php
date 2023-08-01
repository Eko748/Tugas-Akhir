<!DOCTYPE html>
<html>

<head>
    <title>Users List</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        h1 {
            text-align: center;
        }

        .card-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }

        .row {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            width: 100%;
        }

        .card {
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 10px;
            width: calc(50% - 20px);
            margin-bottom: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            display: flex;
            align-items: center;
        }

        .card-image {
            width: 80px;
            margin-right: 10px;
        }

        .card-image img {
            width: 100%;
            border-radius: 5px;
        }

        .column {
            flex: 1;
        }

        .card-content {
            flex: 1;
        }

        .card-line {
            width: 100%;
            height: 1px;
            background-color: #ccc;
            margin-top: 10px;
        }

        .card h2 {
            margin-top: 0;
            margin-bottom: 10px;
        }

        .card p {
            margin: 5px 0;
        }

        @media screen and (max-width: 768px) {
            .card {
                width: 100%;
            }
        }

        .header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 10px 20px;
        }

        .header h2 {
            margin: 0;
        }

        .header img {
            width: 50px;
            height: 50px;
        }
    </style>
</head>

<body>
    <div class="header">
        <table style="width: 100%; border-collapse: collapse;">
            <tr>
                <td style="width: 20%;">
                    <img style="width: 50px; height: 50px" src="{{ public_path('assets/images/logo/scraping.jpg') }}" alt="Logo">
                </td>
                <td style="text-align: right;">
                    <h2>{{ $project->subject }}</h2>
                </td>
            </tr>
        </table>
        <hr style="border: 1px solid #000;">
    </div>

    <div class="card-container" style="padding: 10px">
        @php
            $counter = 1;
        @endphp
        @foreach ($scrapies as $scrapy)
            <table>
                <tr>
                    <td></td>
                    <td></td>
                    <td style="margin-left: 20px; vertical-align: top; text-align: left;"><b>{{ $counter }}.</b></td>
                    <td style="margin-left: 20px; vertical-align: top; text-align: left;"><b>{{ $scrapy->title }}</b></td>
                </tr>
            </table>
            <table>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td style="margin-left: 20px; vertical-align: top; text-align: left;">a.</td>
                    <td></td>
                    <td style="margin-left: 20px; vertical-align: top; text-align: left;">
                        Publisher
                    </td>
                    <td style="vertical-align: top; text-align: left;">:</td>
                    <td style="text-align: justify;">{{ $scrapy->getCategory->category_name }}</td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td style="margin-left: 20px; vertical-align: top; text-align: left;">b.</td>
                    <td></td>
                    <td style="margin-left: 20px; vertical-align: top; text-align: left;">
                        Publication
                    </td>
                    <td style="vertical-align: top; text-align: left;">:</td>
                    <td style="text-align: justify;">{{ $scrapy->publication }}</td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>c.</td>
                    <td></td>
                    <td style="margin-left: 20px; vertical-align: top; text-align: left;">
                        Year
                    </td>
                    <td style="vertical-align: top; text-align: left;">:</td>
                    @php
                        $pattern = '/\b\d{4}\b/';
                        if (preg_match($pattern, $scrapy->year, $matches)) {
                            $year = $matches[0];
                        }
                    @endphp
                    <td>{{ $year }}</td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>d.</td>
                    <td></td>
                    <td style="margin-left: 20px; vertical-align: top; text-align: left;">
                        Type
                    </td>
                    <td style="vertical-align: top; text-align: left;">:</td>
                    <td>{{ $scrapy->type }}</td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>e.</td>
                    <td></td>
                    <td>Detail</td>
                    <td style="vertical-align: top; text-align: left;">:</td>
                    <td><a href="{{ $scrapy->link }}">{{ $scrapy->link }}</a></td>
                </tr>
            </table>
            @php
                $counter++;
            @endphp
        @endforeach
    </div>
</body>

</html>
