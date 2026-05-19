<?php
require_once "Config/connection.php";
require_once "Controller/ProductController.php";

$message = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $controller = new ProductController($conn);

    $data = [
        'name' => $_POST['name'],
        'description' => $_POST['description'],
        'price' => $_POST['price'],
        'quantity' => $_POST['quantity']
    ];

    if ($controller->store($data)) {
        $message = "Product added successfully!";
    } else {
        $message = "Failed to add product.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>

    <style>
        *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body{
            background: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container{
            background: white;
            width: 400px;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        h2{
            text-align: center;
            margin-bottom: 20px;
        }

        .form-group{
            margin-bottom: 15px;
        }

        label{
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        input, textarea{
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        button{
            width: 100%;
            padding: 12px;
            border: none;
            background: #007bff;
            color: white;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover{
            background: #0056b3;
        }

        .message{
            text-align: center;
            margin-bottom: 15px;
            color: green;
        }
    </style>
</head>
<body>

<div class="container">

    <h2>Add Product</h2>

    <?php if($message): ?>
        <div class="message">
            <?= $message ?>
        </div>
    <?php endif; ?>

    <form method="POST">

        <div class="form-group">
            <label>Product Name</label>
            <input type="text" name="name" required>
        </div>

        <div class="form-group">
            <label>Description</label>
            <textarea name="description" rows="4" required></textarea>
        </div>

        <div class="form-group">
            <label>Price</label>
            <input type="number" step="0.01" name="price" required>
        </div>

        <div class="form-group">
            <label>Quantity</label>
            <input type="number" name="quantity" required>
        </div>

        <button type="submit">Add Product</button>

    </form>

</div>

</body>
</html>