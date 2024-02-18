<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Product</title>
    <!-- Agregar estilos CSS -->
    <style>
        form {
            max-width: 400px;
            margin: 0 auto;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="number"],
        input[type="date"],
        textarea {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
        }

        input[type="submit"] {
            padding: 10px;
            background-color: #4caf50;
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 5px;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>

<body>
    <h1>Create Product</h1>
    <form action="{{ route('product.store') }}" method="POST">
        @csrf
        <label for="product_name">Product Name:</label>
        <input type="text" id="product_name" name="product_name" maxlength="50" required>

        <label for="size">Size:</label>
        <select name="size" id="size" required>
            <option value="s">S</option>
            <option value="m">M</option>
            <option value="l">L</option>
        </select>

        <label for="inventory_quantity">Inventory Quantity:</label>
        <input type="number" id="inventory_quantity" name="inventory_quantity" required>

        <label for="shipment_date">Shipment Date:</label>
        <input type="date" id="shipment_date" name="shipment_date" required>

        <label for="observations">Observations:</label>
        <textarea id="observations" name="observations"></textarea>

        <input hidden id="brand_id" name="brand_id" value="{{ $brand->id }}">

        <input type="submit" value="Create Product">
    </form>
</body>

</html>
