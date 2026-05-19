<?php
require_once "config/connection.php";
require_once "Controller/ProductController.php";

$message = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $controller = new ProductController($conn);

    $product_id = $_POST['product_id'];
    $quantity = $_POST['quantity'];

    if ($controller->minustock($product_id, $quantity)) {
        $message = "Stock updated successfully!";
    } else {
        $message = "Failed to update stock.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Minus Stock</title>

    <style>

        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
            font-family: Arial, sans-serif;
        }

        body{
            height:100vh;
            display:flex;
            justify-content:center;
            align-items:center;
            background:#f4f4f4;
        }

        .container{
            width:400px;
            background:white;
            padding:30px;
            border-radius:10px;
            box-shadow:0 0 10px rgba(0,0,0,0.1);
        }

        h2{
            text-align:center;
            margin-bottom:20px;
        }

        .form-group{
            margin-bottom:15px;
        }

        label{
            display:block;
            margin-bottom:5px;
            font-weight:bold;
        }

        input{
            width:100%;
            padding:10px;
            border:1px solid #ccc;
            border-radius:5px;
        }

        button{
            width:100%;
            padding:12px;
            border:none;
            background:#dc3545;
            color:white;
            font-size:16px;
            border-radius:5px;
            cursor:pointer;
        }

        button:hover{
            background:#b02a37;
        }

        .message{
            text-align:center;
            margin-bottom:15px;
            color:green;
        }

    </style>

</head>
<body>

<div class="container">

    <h2>Minus Product Stock</h2>

    <?php if($message): ?>
        <div class="message">
            <?= $message ?>
        </div>
    <?php endif; ?>

    <form method="POST">

        <div class="form-group">
            <label>Product ID</label>
            <input type="number" name="product_id" required>
        </div>

        <div class="form-group">
            <label>Quantity to Subtract</label>
            <input type="number" name="quantity" required>
        </div>

        <button type="submit">Update Stock</button>

    </form>

</div>

</body>
</html>