<!-- resources/views/brands.blade.php -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Brands</title>
    <!-- Agregar estilos CSS -->
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th,
        td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
        }

        .btn {
            padding: 5px 10px;
            border: none;
            background-color: #4caf50;
            color: white;
            cursor: pointer;
            border-radius: 5px;
        }

        .btn-edit {
            background-color: #2196f3;
        }

        .btn-delete {
            background-color: #f44336;
        }

        .btn-create {
            background-color: #ff9800;
            margin-bottom: 2rem
        }
    </style>
</head>

<body>
    <h1>Brands</h1>
    <a href="{{ route('brands.create') }}" class="btn btn-create">Create new brand</a>
    <table style="margin-top: 1rem">
        <thead>
            <tr>
                {{-- <th>ID</th> --}}
                <th>Name</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($brands as $brand)
                <tr id="brand_{{ $brand->id }}">
                    {{-- <td>{{ $brand->id }}</td> --}}
                    <td>{{ $brand->name }}</td>
                    <td>
                        <a href="{{ route('brands.edit', $brand) }}" class="btn btn-edit">Edit</a>
                        <button class="btn btn-delete"
                            onclick="deleteBrand('{{ route('brands.destroy', $brand) }}', '{{ $brand->name }}', '{{ $brand->id }}')">Delete</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <script>
        function deleteBrand(url, brandName, brandId) {
            if (confirm('Are you sure you want to delete ' + brandName + ' brand?')) {
                fetch(url, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                }).then(response => {
                    if (response.ok) {

                        var fila = document.getElementById('brand_' + brandId);

                        if (fila) {
                            fila.parentNode.removeChild(fila);
                            alert('Brand removed successfully.');
                        } else {
                            alert('Error occurred while deleting the brand.');
                        }

                    } else {

                    }
                }).catch(error => {
                    console.error('Error occurred while deleting the brand:', error);
                });
            }
        }
    </script>
</body>

</html>
