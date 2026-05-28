<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="stylesheet" href="/Integrated_Programming/InventorySystem/Inventory-Management-System/Public/Inventory.css">
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Restock Inventory Dashboard</title>


</head>
<?php

require_once "Model/Product.php";
require_once "Controller/ProductController.php";

$controller = new ProductController($conn);
$products = $controller->getAllProducts();

?>
<body>

  <?php 
        $hasCritical = false;
        foreach($products as $product) {
            if($controller->getStatus($product['stock_quantity']) === 'CRITICAL') {
                $hasCritical = true;
                break;
            }
        }
        ?>

        <?php if($hasCritical): ?>
      <div class="warning-overlay" id="warningPopup">
        <div class="warning-box">
          <h2>⚠️ Critical Stock Alert</h2>
          <p>One or more products are critically low on stock. Please restock immediately.</p>
          <button onclick="document.getElementById('warningPopup').style.display='none'">
            OK, Got it
          </button>
        </div>
      </div>
      <?php endif; ?>

  <!-- SIDEBAR -->

   <div class="sidebar">
    <h2>InventorySys</h2>
    <ul>
      <li><a href="index.php?action=dashboard">Dashboard</a></li>
      <li><a href="index.php?action=logout">Log Out</a></li>

      
      <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
      <li><a href="index.php?action=inventory">Inventory</a></li>
      <li><a href="index.php?action=transaction-history">Transaction History</a></li>
      <li><a href="index.php?action=request-tracking">Confirm Product Request</a></li>
      <li><a href="index.php?action=archived">Archive</a></li>
      <li><a href="index.php?action=registerPage">User Management</a></li>
      <li><a href="index.php?action=user-information">User Information</a></li>
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

      <div class="card">
        <h3>Pending Restocks</h3>
        <p><?= $controller->needRestocks() ?></p>
      </div>

      <div class="card">
        <h3>Products</h3>
        <p><?= $controller->countProducts() ?></p>
      </div>

      <div class="card">
        <h3>Restocked Today</h3>
        <p>34</p>
      </div>

    </div>

    <!-- INVENTORY TABLE -->

    <div class="table-container">

     <div class="table-header">
  <h2>Inventory Overview</h2>
  <div class="table-actions">
    <input type="text" id="searchInput" placeholder="Search product..." onkeyup="searchTable()">
    <a href="index.php?action=addProduct" class="add-btn">+ Add Product</a>
  </div>
</div>

      <table>

       <thead>
  <tr>
    <th>Product</th>
    <th>Stock</th>
    <th>Unit</th>
    <th>Status</th>
    <th colspan="2">Control</th>
  </tr>
</thead>

<tbody>
  <?php foreach($products as $product): ?>
    <?php $status = $controller->getStatus($product['stock_quantity']); ?>
    <tr>
      <td><?= htmlspecialchars($product['product_name']) ?></td>
      <td><?= htmlspecialchars($product['stock_quantity']) ?></td>
      <td><?= htmlspecialchars($product['unit'] ?? '') ?></td>
      <td>
        <span class="status <?= strtolower($status) ?>">
          <?= $status ?>
        </span>
      </td>
      <td>
        <form action="index.php?action=restock" method="POST">
          <input type="hidden" name="product_id" value="<?= $product['product_id'] ?>">
<a href="index.php?action=restock-page&product_id=<?= $product['product_id'] ?>&product_name=<?= urlencode($product['product_name']) ?>&unit=<?= urlencode($product['unit'] ?? '') ?>" class="restock-btn">Restock</a>
        </form>
      </td>
      <td>
        <form action="index.php?action=archive" method="POST">
          <input type="hidden" name="product_id" value="<?= $product['product_id'] ?>">
          <button type="submit" class="archive-btn" onclick="return confirm('Archive this product?')">Archive</button>
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
    const name = row.cells[0].textContent.toLowerCase();
    row.style.display = name.includes(input) ? '' : 'none';
  });
}

  </script>

</body>
</html>