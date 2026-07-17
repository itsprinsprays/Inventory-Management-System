<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <link rel="stylesheet" href="/Integrated_Programming/InventorySystem/Inventory-Management-System/Public/Register.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>

<!-- SIDEBAR -->
<div class="sidebar">
    <h2>InventorySys</h2>
    <ul>
        <li><a href="index.php?action=dashboard"><i class="fas fa-gauge"></i> Dashboard</a></li>

        <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
            <li><a href="index.php?action=inventory"><i class="fas fa-boxes-stacked"></i> Inventory</a></li>
            <li><a href="index.php?action=transaction-history"><i class="fas fa-clock-rotate-left"></i> Transaction History</a></li>
            <li><a href="index.php?action=confirm-request"><i class="fas fa-circle-check"></i> Confirm Product Request</a></li>
            <li><a href="index.php?action=archived"><i class="fas fa-box-archive"></i> Archive</a></li>
            <li><a href="index.php?action=registerPage"><i class="fas fa-users-gear"></i> User Management</a></li>
            <li><a href="index.php?action=user-information"><i class="fas fa-id-card"></i> User Information</a></li>
            <li><a href="index.php?action=import-xml"><i class="fas fa-file-import"></i> Import XML Files</a></li>
        <?php endif; ?>

        <li class="logout">
            <a href="index.php?action=logout"><i class="fas fa-right-from-bracket"></i> Log Out</a>
        </li>
    </ul>
</div>

<!-- MAIN CONTENT -->
<div class="main">

    <!-- REGISTER FORM -->
    <div class="container">
        <h2>Register</h2>
<!-- Form should now look like this -->
    <form method="POST" action="index.php?action=register">
        <input type="password" name="password"    placeholder="Password"    required>
        <select name="role" required>
            <option value="">Select Role</option>
            <option value="admin">Admin</option>
            <option value="employee">Teacher</option>
        </select>
        <input type="number"   name="employee_id" placeholder="Employee ID" required>
        <button type="submit">Register</button>
    </form>
        <div class="message <?= htmlspecialchars($messageType ?? '') ?>">
        <?= htmlspecialchars($message ?? '') ?>
    </div>
    </div>

    <!-- VIEW USERS TABLE -->
    <div class="table-container">
        <div class="table-header">
            <h3><i class="fas fa-users"></i> Registered Users</h3>
        </div>
        <table>
            <thead>
                <tr>
                    <th>Employee ID</th>
                    <th>Username</th>
                    <th>Role</th>
                    <th>Action</th>
                </tr>
            </thead>
          <tbody>
    <?php if (!empty($users)): ?>
        <?php foreach ($users as $user): ?>
            <tr>
                <td><?= htmlspecialchars($user['Employee_id']) ?></td>
                <td><?= htmlspecialchars($user['username']) ?></td>
                <td><?= htmlspecialchars($user['role']) ?></td>
                <td>
                    <a href="index.php?action=deleteUser&id=<?= $user['Employee_id'] ?>" 
                       class="delete-btn"
                       onclick="return confirm('Delete this user?')">
                        <i class="fas fa-trash"></i> Delete
                    </a>
                    <button class="edit-btn" onclick="toggleEdit(<?= $user['Employee_id'] ?>)">
                        <i class="fas fa-pen"></i> Edit
                    </button>
                </td>
            </tr>
            <!-- Inline edit row (hidden by default) -->
            <tr class="edit-row" id="edit-<?= $user['Employee_id'] ?>" style="display:none;">
                <td colspan="4">
                    <form method="POST" action="index.php?action=updateRole" class="edit-form">
                        <input type="hidden" name="employee_id" value="<?= $user['Employee_id'] ?>">
                        <label>New Role:</label>
                        <select name="role" required>
                            <option value="admin"    <?= $user['role'] === 'admin'    ? 'selected' : '' ?>>Admin</option>
                            <option value="employee" <?= $user['role'] === 'employee' ? 'selected' : '' ?>>Employee</option>
                        </select>
                        <button type="submit" class="save-btn"><i class="fas fa-check"></i> Save</button>
                        <button type="button" class="cancel-btn" onclick="toggleEdit(<?= $user['Employee_id'] ?>)">
                            <i class="fas fa-x"></i> Cancel
                        </button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr>
            <td colspan="5" style="color: #475569; padding: 30px;">No users registered yet.</td>
        </tr>
    <?php endif; ?>
</tbody>
        </table>
    </div>

</div>

</body>

<script>
    function toggleEdit(id) {
        const row = document.getElementById('edit-' + id);
        row.style.display = row.style.display === 'none' ? 'table-row' : 'none';
    }
</script>
</html>