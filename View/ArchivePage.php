<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="stylesheet" href="/Integrated_Programming/InventorySystem/Inventory-Management-System/Public/Archive.css">
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Restock Inventory Dashboard</title>
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

</head>

        <?php

        require_once "Model/Product.php";
        require_once "Controller/ProductController.php";
        require_once "Model/Archive.php";
        require_once "Controller/ArchiveController.php";

        $controller = new ProductController($conn);
        $products = $controller->getAllProducts();

        $controllerArch = new ArchiveController($conn);
        $archive = $controllerArch->getAllArchive();
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

    <div class="cards">

      <div class="card">
        <h3>Critical Stock Items</h3>
        <p><?= $controller->countCriticalStock() ?></p>
      </div>

    </div>

    <!-- INVENTORY TABLE -->

    <div class="table-container">

      <div class="table-header">
        <h2>Archive</h2>
      </div>

      <table>

        <thead>
  <tr>
    <th>Product ID</th>
    <th>Name</th>
    <th>Stock</th>
    <th>Unit</th>
    <th>Description</th>
    <th>Archived Date</th>
    <th>Control</th>
  </tr>
</thead>

<tbody>
  <?php foreach ($archive as $archive): ?>
    <tr>
      <td><?= htmlspecialchars($archive['product_id']) ?></td>
      <td><?= htmlspecialchars($archive['product_name']) ?></td>
      <td><?= htmlspecialchars($archive['stock_quantity']) ?></td>
      <td><?= htmlspecialchars($archive['unit'] ?? '') ?></td>
      <td><?= htmlspecialchars($archive['description']) ?></td>
      <td><?= htmlspecialchars($archive['archived_at']) ?></td>
      <td>
        <form action="index.php?action=activateProduct" method="POST">
          <input type="hidden" name="product_id" value="<?= $archive['product_id'] ?>">
          <button type="submit" class="pullout-btn" onclick="return confirm('Activate this product?')">Activate</button>
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