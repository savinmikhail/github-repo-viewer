<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Top Repositories</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            padding: 0;
            box-sizing: border-box;
        }

        #repositories-list {
            background-color: #f4f4f4;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #4CAF50;
            color: white;
        }
        a {
            display: inline-block;
            margin-bottom: 20px;
            padding: 10px 15px;
            background-color: #4CAF50;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }

        a:hover {
            background-color: #45a049;
        }
    </style>
</head>

<body>
<a href="/owners">Go to Owners</a>

    <div id="repositories-list">
        <table>
            <thead>
                <tr>
                    <th>Repo ID</th>
                    <th>Repo Name</th>
                    <th>URL</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($repositories as $repo)
                <tr>
                    <td>{{ $repo['id'] }}</td>
                    <td>{{ $repo['name'] }}</td>
                    <td>{{ $repo['url']}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</body>

</html>
