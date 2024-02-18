<!-- resources/views/products/index.blade.php -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
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
        }
    </style>
</head>

<body>
    <h1>Product List of {{ $brand->name }} brand</h1>
    <a href="{{ route('product.create', $brand) }}" class="btn btn-create">Create new product</a>
    <a href="{{ route('brands.index') }}" class="btn btn-create">Return to brands</a>
    <table style="margin-top: 1rem;">
        <thead>
            <tr>
                {{-- <th>ID</th> --}}
                <th>Product Name</th>
                <th>Size</th>
                <th>Inventory Quantity</th>
                <th>Shipment Date</th>
                <th>Observations</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
                <tr id="product_{{ $product->id }}">
                    {{-- <td>{{ $product->id }}</td> --}}
                    <td>{{ $product->product_name }}</td>
                    <td>{{ strtoupper($product->size) }}</td>
                    <td>{{ $product->inventory_quantity }}</td>
                    <td>{{ $product->shipment_date }}</td>
                    <td>{{ $product->observations }}</td>
                    <td>
                        <a href="{{ route('product.edit', $product) }}" class="btn btn-edit">Edit</a>
                        <button class="btn btn-delete"
                            onclick="deleteProduct('{{ route('product.destroy', $product) }}', '{{ $product->product_name }}', '{{ $product->id }}')">Delete</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

<script>
    function deleteProduct(url, productName, productId) {
        if (confirm('Are you sure you want to delete (' + productName + ') product?')) {
            fetch(url, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            }).then(response => {
                if (response.ok) {

                    var fila = document.getElementById('product_' + productId);

                    if (fila) {
                        fila.parentNode.removeChild(fila);
                        alert('product removed successfully.');
                    } else {
                        alert('Error occurred while deleting the product.');
                    }

                } else {

                }
            }).catch(error => {
                console.error('Error occurred while deleting the product:', error);
            });
        }
    }
</script>

</html>
