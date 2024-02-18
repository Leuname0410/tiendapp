<!-- resources/views/brands/create.blade.php -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Brand</title>
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

        input[type="text"] {
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
    <h1>Create Brand</h1>
    <form action="{{ route('brands.store') }}" method="POST">
        @csrf
        <label for="name">Brand Name:</label>
        <input type="text" id="name" name="name" maxlength="50" required>
        <input type="submit" value="Create Brand">
    </form>
</body>

</html>
