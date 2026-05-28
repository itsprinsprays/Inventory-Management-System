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
        require_once "Model/Transaction.php";
        require_once "Controller/TransactionController.php";

        $controller = new ProductController($conn);
        $products = $controller->getAllProducts();
        $requestController = new RequestController($conn);
        $request = $requestController->getAllRequest();
        $transactionController = new TransactionController($conn);
        $transaction = $transactionController->getAllTransaction();
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
        <h2>Transaction History</h2>
      </div>

      <table>

        <thead>
          <tr>
            <th>Request ID</th>
            <th>Product ID</th>
            <th>Product Name</th>
            <th>Stock Quantity</th>
            <th>Request Date</th>
            <th>Confirm Request Date</th> 
            <th>Employee Name </th>
            <th>Employee ID</th>

          </tr>
        </thead>
    
        <tbody>
    <?php foreach ($transaction as $transaction): ?>
        <tr>
        <td><?= htmlspecialchars($transaction['transaction_id']) ?></td>
        <td><?= htmlspecialchars($transaction['product_id']) ?></td>
        <td><?= htmlspecialchars($transaction['product_name']) ?></td>
        <td><?= htmlspecialchars($transaction['stock_quantity']) ?></td>
        <td><?= htmlspecialchars($transaction['request_date']) ?></td>
        <td><?= htmlspecialchars($transaction['confirmRequest']) ?></td>
        <td><?= htmlspecialchars($transaction['employee_name']) ?></td>
        <td><?= htmlspecialchars($transaction['employee_id']) ?></td>
        <td>
            <form action="index.php?action=confirm-request-submit" method="POST">
            <input type="hidden" name="request_id"     value="<?= $transaction['transaction_id'] ?>">
            <input type="hidden" name="product_id"     value="<?= $transaction['product_id'] ?>">
            <input type="hidden" name="product_name"   value="<?= $transaction['product_name'] ?>">
            <input type="hidden" name="stock_quantity" value="<?= $transaction['stock_quantity'] ?>">
            <input type="hidden" name="request_date"   value="<?= $transaction['request_date'] ?>">
            <input type="hidden" name="confirmRequest"   value="<?= $transaction['confirmRequest'] ?>">
            <input type="hidden" name="employee_name"  value="<?= $transaction['employee_name'] ?>">
            <input type="hidden" name="employee_id"    value="<?= $transaction['employee_id'] ?>">
        
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