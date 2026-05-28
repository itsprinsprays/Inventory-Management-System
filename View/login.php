<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<link rel = "StyleSheet" href="/Integrated_Programming/InventorySystem/Inventory-Management-System/Public/Login.css">
<body>

<div class="container">

    <h2>Login</h2>

    <form method="POST" action="index.php?action=login">

        <input type="text" name="username" placeholder="Username" required>

        <input type="password" name="password" placeholder="Password" required>

        <button type="submit">Login</button>

    </form>

    <div class="message">
        <?= $message ?? '' ?>
    </div>

</div>

</body>
</html>