<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Employee</title>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500;600&family=Syne:wght@700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="/Integrated_Programming/InventorySystem/Inventory-Management-System/Public/EditEmployee.css">

</head>
<body>

<div class="container">
    <div class="header">
        <div class="label">Employee Management</div>
        <h1>Edit<br>Employee</h1>
        <p class="employee-id">ID: <span>#<?= htmlspecialchars($employee['Employee_id']) ?></span></p>
    </div>

    <?php if (!empty($message)): ?>
        <div class="alert <?= str_contains($message, 'success') ? 'alert-success' : 'alert-error' ?>">
            <?= htmlspecialchars($message) ?>
        </div>
    <?php endif; ?>

    <div class="card">
        <form method="POST" action="index.php?action=edit-employee">
    <!-- ADD THIS — without it, the update has no target -->
    <input type="hidden" name="Employee_id" value="<?= htmlspecialchars($employee['Employee_id']) ?>">

    <div class="form-group">
        <label for="name">Full Name</label>
        <input type="text" id="name" name="name"
            value="<?= htmlspecialchars($employee['name'] ?? '') ?>" required>
    </div>

    <div class="form-group">
        <label for="contact_number">Contact Number</label>
        <input type="text" id="contact_number" name="contact_number"
            value="<?= htmlspecialchars($employee['contact_number'] ?? '') ?>" required>
    </div>

    <div class="form-group">
        <label for="email">Email Address</label>
        <input type="email" id="email" name="email"
            value="<?= htmlspecialchars($employee['email'] ?? '') ?>" required>
    </div>

    <div class="form-group">
        <label for="address">Address</label>
        <textarea id="address" name="address" required><?= htmlspecialchars($employee['address'] ?? '') ?></textarea>
    </div>

    <div class="actions">
        <a href="index.php?action=user-information" style="flex:1; text-decoration:none;">
            <button type="button" class="btn btn-secondary" style="width:100%">Back</button>
        </a>
        <button type="submit" class="btn btn-primary">Save Changes</button>
    </div>
</form>
    </div>
</div>

</body>
</html>