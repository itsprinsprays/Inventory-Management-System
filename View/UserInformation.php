<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="stylesheet" href="/Integrated_Programming/InventorySystem/Inventory-Management-System/Public/UserInformations.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
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

  <li class="logout" style="margin-top: auto;">
    <a href="index.php?action=logout"><i class="fas fa-right-from-bracket"></i><span style="color: red"> Log Out</span></a>
  </li>
</ul>
</div>
  <!-- MAIN -->

  <div class="main">

    <!-- DASHBOARD CARDS -->

   

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