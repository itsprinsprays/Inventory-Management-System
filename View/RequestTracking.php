<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="stylesheet" href="/Integrated_Programming/InventorySystem/Inventory-Management-System/Public/Dashboards.css">
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Restock Inventory Dashboard</title>


</head>

        <?php

        require_once "Model/Product.php";
        require_once "Controller/ProductController.php";
        require_once "Model/Request.php";
        require_once "Controller/RequestController.php";

        $controller = new ProductController($conn);
        $products = $controller->getAllProducts();
        $requestController = new RequestController($conn);
        $request = $requestController->getAllRequest();
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
        <h2>Request Tracking Overview</h2>
      </div>

      <table>

        <thead>
          <tr>
            <th>Request ID</th>
            <th>Product ID</th>
            <th>Product Name</th>
            <th>Stock Quantity</th>
            <th>Request Date</th> 
            <th>Employee ID</th>
            <th>Control</th>

          </tr>
        </thead>
    
      <tbody>
        <?php foreach ($request as $request) :?>
          <tr>
            <td><?= htmlspecialchars($request['request_id']) ?></td>
            <td><?= htmlspecialchars($request['product_id']) ?></td>
            <td><?= htmlspecialchars($request['product_name']) ?></td>
            <td><?= htmlspecialchars($request['stock_quantity']) ?></td>
            <td><?= htmlspecialchars($request['request_date']) ?></td>
            <td><?= htmlspecialchars($request['employee_id']) ?></td>
        
            </td>
            <td>
              <form action="index.php?action=request-Page" method="POST">
            <input type="hidden" name="product_name" value="<?= htmlspecialchars($product['product_name']) ?>">
      <a href="index.php?action=request-Page&product_id=<?= $product['product_id'] ?>&product_name=<?= urlencode($product['product_name']) ?>" class="pullout-btn">Request</a>
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