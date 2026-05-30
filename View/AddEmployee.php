<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Employee</title>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500;600&family=Syne:wght@700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="/Integrated_Programming/InventorySystem/Inventory-Management-System/Public/AddEmployee.css">
</head>
<body>

<div class="container">
    <div class="header">
        <div class="label">Employee Management</div>
        <h1>Add New<br>Employee</h1>
    </div>

    <?php if (!empty($message)): ?>
        <div class="alert <?= str_contains($message, 'success') ? 'alert-success' : 'alert-error' ?>">
            <?= htmlspecialchars($message) ?>
        </div>
    <?php endif; ?>

    <div class="card">
        <form method="POST" action="index.php?action=add-employee">
            <div class="form-group">
                <label for="name">Full Name</label>
                <input type="text" id="name" name="name" placeholder="e.g. Juan Dela Cruz" required>
            </div>

            <div class="form-group">
                <label for="contact_number">Contact Number</label>
                <input type="text" id="contact_number" name="contact_number" placeholder="e.g. 09171234567" required>
            </div>

            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" id="email" name="email" placeholder="e.g. juan@email.com" required>
            </div>

            <div class="form-group">
                <label for="address">Address</label>
                <textarea id="address" name="address" placeholder="Street, City, Province" required></textarea>
            </div>

            <div class="actions">
                <a href="index.php?action=user-information" style="flex:1; text-decoration:none;">
                    <button type="button" class="btn btn-secondary" style="width:100%">Back</button>
                </a>
                <button type="submit" class="btn btn-primary">Add Employee</button>
            </div>
        </form>
    </div>
</div>

</body>
</html>