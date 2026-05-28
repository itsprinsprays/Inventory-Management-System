<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
</head>

<link rel = "StyleSheet" href="/Integrated_Programming/InventorySystem/Inventory-Management-System/Public/Register.css">
<body>

<div class="container">

    <h2>Register</h2>

    <form method="POST" action="index.php?action=register">

        <input type="text" name="username" placeholder="Username" required>

        <input type="password" name="password" placeholder="Password" required>

        <select name="role" required>
            <option value="">Select Role</option>
            <option value="admin">Admin</option>
            <option value="employee">Teacher</option>
        </select>

        <input type="number" name="employee_id" placeholder="Employee ID" required>

        <button type="submit">Register</button>

    </form>

    <div class="message">
        <?= $message ?? '' ?>
    </div>


</div>

</body>
</html>