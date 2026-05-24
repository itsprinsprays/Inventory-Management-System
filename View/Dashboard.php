<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="stylesheet" href="/Integrated_Programming/InventorySystem/Inventory-Management-System/Public/Dashboard.css">
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

  <!-- SIDEBAR -->

  <div class="sidebar">
    <h2>InventorySys</h2>
    <ul>
      <li><a href="index.php?action=dashboard">Dashboard</a></li>
      <li><a href="index.php?action=logout">Log Out</a></li>

      
      <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
      <li><a href="index.php?action=inventory">Inventory</a></li>
      <li><a href="#">Transaction History</a></li>
      <li><a href="#">Request Tracking</a></li>
      <li><a href="#">Confirm Product Request</a></li>
      <li><a href="index.php?action=archived">Archive</a></li>
        <li><a href="#">User Management</a></li>
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
      </div>

      <table>

        <thead>
          <tr>
            <th>Product</th>
            <th>Stock</th>
            <th>Status</th>
            <th>Control</th>
          </tr>
        </thead>
    
      <tbody>
        <?php foreach ($products as $product): ?>
          <?php $status = $controller->getStatus($product['stock_quantity']); ?>
          <tr>
            <td><?= htmlspecialchars($product['product_name']) ?></td>
            <td><?= htmlspecialchars($product['stock_quantity']) ?></td>
            <td>
              <span class="status <?= strtolower($status) ?>">
                <?= $status ?>
              </span>
            </td>
            <td>
              <form action="/pullout" method="POST">
                <input type="hidden" name="product_id" value="<?= $product['product_id'] ?>">
                <button type="submit" class="pullout-btn" onclick="showToast()">Request</button>
              </form>
          </tr>
        <?php endforeach; ?>
      </tbody

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