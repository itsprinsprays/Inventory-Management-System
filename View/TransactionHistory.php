<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="stylesheet" href="/Integrated_Programming/InventorySystem/Inventory-Management-System/Public/Transactionn.css">
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Restock Inventory Dashboard</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

</head>

<style>

    </style>

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
        <h2>Transaction History</h2>
      </div>

      <table>

        <thead>
  <tr>
    <th>Transaction ID</th>
    <th>Product ID</th>
    <th>Product Name</th>
    <th>Stock Quantity</th>
    <th>Unit</th>
    <th>Request Date</th>
    <th>Confirm Date</th>
    <th>Employee Name</th>
    <th>Employee ID</th>
    <th>Status</th>
  </tr>
</thead>

<tbody>
  <?php foreach ($transaction as $transaction): ?>
    <tr>
      <td><?= htmlspecialchars($transaction['transaction_id']) ?></td>
      <td><?= htmlspecialchars($transaction['product_id']) ?></td>
      <td><?= htmlspecialchars($transaction['product_name']) ?></td>
      <td><?= htmlspecialchars($transaction['stock_quantity']) ?></td>
      <td><?= htmlspecialchars($transaction['unit'] ?? '') ?></td>
      <td><?= htmlspecialchars($transaction['request_date']) ?></td>
      <td><?= htmlspecialchars($transaction['confirmRequest']) ?></td>
      <td><?= htmlspecialchars($transaction['employee_name']) ?></td>
      <td><?= htmlspecialchars($transaction['employee_id']) ?></td>
      <td>
        <span class="status <?= strtolower($transaction['status']) ?>">
          <?= htmlspecialchars($transaction['status']) ?>
        </span>
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