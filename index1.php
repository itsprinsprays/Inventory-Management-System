<?php
require_once "config/connection.php";
require_once "Controller/ProductController.php";
require_once "Controller/TeacherController.php";

$ProductController = new ProductController($conn);
$TeacherController = new TeacherController($conn);

$products = $ProductController->getAllProducts();
$teachers = $TeacherController->getAllTeachers();

$message = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $product_id = $_POST['product_id'];
    $quantity   = $_POST['quantity'];

    if ($ProductController->minustock($product_id, $quantity)) {
        header("Location: ".$_SERVER['PHP_SELF']."?success=1");
        exit;
    } else {
        header("Location: ".$_SERVER['PHP_SELF']."?error=1");
        exit;
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Minus Stock</title>
</head>

<style>
body{
    font-family: Arial;
    display:flex;
    justify-content:center;
    align-items:center;
    height:100vh;
    background:#f4f4f4;
}

.container{
    width:400px;
    padding:20px;
    background:white;
    border-radius:10px;
    box-shadow:0 0 10px rgba(0,0,0,0.1);
}

select, input, button{
    width:100%;
    padding:10px;
    margin-top:10px;
}

button{
    background:red;
    color:white;
    border:none;
    cursor:pointer;
}
</style>

<body>

<div class="container">

    <h2>Minus Stock</h2>

    <?php if($message): ?>
        <p style="color:green;"><?= $message ?></p>
    <?php endif; ?>

    <form method="POST">

        <!-- PRODUCT DROPDOWN -->
        <label>Select Product</label>
        <select name="product_id" required>
            <option value="">-- Select Product --</option>

            <?php foreach ($products as $p): ?>
                <option value="<?= $p['product_id'] ?>">
                    <?= $p['product_name'] ?> (Stock: <?= $p['stock_quantity'] ?>)
                </option>
            <?php endforeach; ?>

        </select>

        <label>-- Select Teacher -- </label>
        <select name = "teacher_id" required>
            <option value ="">-- Select Teacher --</option>

            <?php foreach ($teachers as $t): ?>
                <option value="<?= $t['teacher_id'] ?>">
                    <?= $t['teacher_name'] ?> 
                </option>
            <?php endforeach; ?>
        </select>

        <label>Quantity to Deduct</label>
        <input type="number" name="quantity" required>

        <button type="submit">Update Stock</button>

    </form>

    <?php if(isset($_GET['success'])): ?>
    <p style="color:green;">Stock updated successfully!</p>
<?php elseif(isset($_GET['error'])): ?>
    <p style="color:red;">Failed to update stock.</p>
<?php endif; ?>

</div>

</body>
</html>