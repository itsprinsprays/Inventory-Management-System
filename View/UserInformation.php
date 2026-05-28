<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="stylesheet" href="/Integrated_Programming/InventorySystem/Inventory-Management-System/Public/Archive.css">
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
        $employee = $employeeController->getallEmployees();
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
      <li><a href="#">Transaction History</a></li>
      <li><a href="index.php?action=confirm-request">Confirm Product Request</a></li>
      <li><a href="#">Archive</a></li>
        <li><a href="index.php?action=registerPage">User Management</a></li>
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
      </div>

      <table>

        <thead>
  <tr>
    <th>Employee ID</th>
    <th>Name</th>
    <th>Contact Number</th>
    <th>Email</th>
    <th><Address></Address></th>
    <th>Control</th>
  </tr>
</thead>

<tbody>
  <?php foreach ($employee as $employee): ?>
    <tr>
      <td><?= htmlspecialchars($employee['Employee_id']) ?></td>
      <td><?= htmlspecialchars($employee['name']) ?></td>
      <td><?= htmlspecialchars($employee['contact_number']) ?></td>
      <td><?= htmlspecialchars($employee['email'] ) ?></td>
      <td><?= htmlspecialchars($employee['address']) ?></td>
      <td>
        <form action="index.php?action=activateProduct" method="POST">
          <input type="hidden" name="product_id" value="<?= $employee['Employee_id'] ?>">
          <button type="submit" class="pullout-btn" onclick="return confirm('Update this Employee?')">Update</button>
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

  </script>

</body>
</html>