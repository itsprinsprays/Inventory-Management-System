<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="stylesheet" href="/Integrated_Programming/InventorySystem/Inventory-Management-System/Public/UserInformation.css">
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Restock Inventory Dashboard</title>


</head>

        <?php

        require_once "Model/Product.php";
        require_once "Controller/ProductController.php";
        require_once "Model/Archive.php";
        require_once "Controller/ArchiveController.php";
        require_once "Model/Employee.php";
        require_once "Controller/EmployeeController.php";

        $controller = new ProductController($conn);
        $products = $controller->getAllProducts();

        $controllerArch = new ArchiveController($conn);
        $archive = $controllerArch->getAllArchive();

        $employeeController = new EmployeeController($conn);
        $employees = $employeeController->getallEmployees();
        ?>
        
<body>

  <!-- SIDEBAR -->

  <div class="sidebar">
    <h2>InventorySys</h2>
    <ul>
      <li><a href="index.php?action=dashboard">Dashboard</a></li>
      <li><a href="index.php?action=logout">Log Out</a></li>

      
      <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
      <li><a href="index.php?action=inventory">Inventory</a></li>
      <li><a href="index.php?action=transaction-history">Transaction History</a></li>
      <li><a href="index.php?action=confirm-request">Confirm Product Request</a></li>
      <li><a href="index.php?action=archived">Archive</a></li>
      <li><a href="index.php?action=registerPage">User Management</a></li>
      <li><a href="index.php?action=user-information">User Information</a></li>
      <li><a href="index.php?action=import-xml">Import XML Files</a></li>
      <?php endif; ?>
    </ul>
  </div>

  <!-- MAIN -->

  <div class="main">

    <!-- DASHBOARD CARDS -->

    <div class="cards">

      <div class="card">
        <h3>Critical Stock Items</h3>
        <p><?= $controller->countCriticalStock() ?></p>
      </div>

    </div>

    <!-- INVENTORY TABLE -->

    <div class="table-container">

      <div class="table-header">
        <h2>User Information</h2>
         <div class="table-actions">
    <input type="text" id="searchInput" placeholder="Search Employee..." onkeyup="searchTable()">
    <a href="index.php?action=add-employee" class="add-btn">+ Add Employee</a>
  </div>
      </div>

      <table>

        <thead>
  <tr>
    <th>Employee ID</th>
    <th>Name</th>
    <th>Contact Number</th>
    <th>Email</th>
    <th>Address</th>
    <th colspan = 2>Control</th>
  </tr>
</thead>

<tbody>
  <?php foreach ($employees as $employee): ?>
    <tr>
      <td><?= htmlspecialchars($employee['Employee_id']) ?></td>
      <td><?= htmlspecialchars($employee['name']) ?></td>
      <td><?= htmlspecialchars($employee['contact_number']) ?></td>
      <td><?= htmlspecialchars($employee['email'] ) ?></td>
      <td><?= htmlspecialchars($employee['address']) ?></td>
      <td>
    <form action="index.php?action=edit-employee" method="GET">
        <input type="hidden" name="action" value="edit-employee">
        <input type="hidden" name="employee_id" value="<?= $employee['Employee_id'] ?>">
        <button type="submit" class="pullout-btn" onclick="return confirm('Update this Employee?')">Update</button>
    </form>
</td>
      <td>
        <form action="index.php?action=delete-employee" method="POST">
          <input type="hidden" name="employee_id" value="<?= $employee['Employee_id'] ?>">
          <button type="submit" class="pullout-btn" onclick="return confirm('Delete this Employee?')">Delete</button>
        </form>
      </td>
    </tr>
  <?php endforeach; ?>
</tbody>

      </table>
    </div>
  </div>

  <!-- SUCCESS TOAST -->

  <div class="toast" id="toast">
    ✓ Stock Updated Successfully
  </div>

  <script>

    function showToast(){

      const toast = document.getElementById("toast");

      toast.style.display = "block";

      setTimeout(() => {
        toast.style.display = "none";
      }, 3000);
    }

      function searchTable() {
  const input = document.getElementById('searchInput').value.toLowerCase();
  const rows = document.querySelectorAll('tbody tr');
  rows.forEach(row => {
    const name = row.cells[1].textContent.toLowerCase();
    row.style.display = name.includes(input) ? '' : 'none';
  });
}

  </script>

</body>
</html>