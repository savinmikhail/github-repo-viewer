<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Owners Management</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            padding: 0;
            box-sizing: border-box;
        }

        #owners-list {
            background-color: #f4f4f4;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        form {
            display: flex;
            margin-bottom: 20px;
        }

        input {
            flex: 1;
            padding: 10px;
        }

        button {
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #4CAF50;
            color: white;
        }

        .actions {
            display: flex;
        }

        .delete {
            margin-right: 10px;
            cursor: pointer;
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
    <a href="/">Go to Repos</a>
    @php
        $success = session('success');
    @endphp

    @if(isset($success))
        @if ($success == 1)
            <p>Owner added successfully</p>
        @elseif (!$success)
            <p>Owner not found in GitHub</p>
        @endif
    @endif
    <div id="owners-list">
        <h2>Owners List</h2>
        <form id="addOwnerForm" action="{{ route('owner.add') }}" method="POST">
            @csrf
            <input type="text" name="name" id="ownerName" placeholder="Enter owner name" required>
            <button type="submit">Add Owner</button>
        </form>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="ownersTableBody">
                @foreach ($owners as $owner)
                <tr data-owner-id="{{ $owner->id }}">
                    <td>{{ $owner->id }}</td>
                    <td>{{ $owner->name }}</td>
                    <td class="actions">
                        <button class="delete" onclick="deleteOwner('{{ $owner->id }}')">Delete</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>


</body>

</html>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    function deleteOwner(ownerId) {
        if (confirm('Are you sure you want to delete this owner?')) {
            $.ajax({
                url: "{{ route('owner.delete', ':ownerId') }}".replace(':ownerId', ownerId),
                type: 'DELETE',
                success: function(response) {
                    location.reload();
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        }
    }
</script>