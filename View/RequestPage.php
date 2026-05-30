<!DOCTYPE html>
<html>
<title>Restock Request</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/5/w3.css">
<style>

  .page-wrapper {
    margin-top: 80px;
    text-align: center;
  }

  .form-card {
    max-width: 420px;
    margin: auto;
    border-radius: 12px;
    overflow: hidden;
  }

  .form-header p {
    margin: 4px 0 0;
    font-size: 13px;
    opacity: 0.85;
  }

  .form-header h3 {
    margin: 0;
  }

  .form-body {
    padding: 24px;
  }

  .form-label {
    font-size: 13px;
    font-weight: 600;
  }

  .form-footer {
    display: flex;
    gap: 8px;
  }

  .btn-back {
    flex: 1;
    text-decoration: none;
  }

  .btn-submit {
    flex: 2;
  }

</style>

<?php
  require_once "Model/Product.php";
  require_once "Controller/ProductController.php";
  require_once "Controller/RequestController.php";
http://localhost/Integrated_Programming/InventorySystem/Inventory-Management-System/index.php?action=transaction-history#
  $controller = new ProductController($conn);
  $requestController = new RequestController($conn);

  $product_id   = $_GET['product_id'] ?? '';
  $product_name = $_GET['product_name'] ?? '';
  $unit         = $_GET['unit'] ?? ''; 
  $stock_quantity = $_GET['stock_quantity'] ?? 0;
?>

<body>

<div class="page-wrapper">
  <div class="form-card w3-card-4">

    <!-- Header -->
    <div class="form-header w3-blue w3-padding-16">
      <h3>Restock Request</h3>
      <p>Fill in the details below</p>
    </div>

    <!-- Form body -->
    <form action="index.php?action=submit-request" method="POST">

      <input type="hidden" name="product_id"   value="<?= htmlspecialchars($product_id) ?>">
      <input type="hidden" name="employee_id"  value="<?= htmlspecialchars($_SESSION['employee_id'] ?? '') ?>">

      <div class="form-body w3-container">

        <label class="form-label w3-text-grey">PRODUCT NAME</label>
        <input class="w3-input w3-border w3-round w3-margin-bottom"
          type="text" name="product_name" value="<?= htmlspecialchars($product_name) ?>" readonly required>

        <label class="form-label w3-text-grey">UNIT</label>
        <input class="w3-input w3-border w3-round w3-margin-bottom"
          type="text" name="unit" value="<?= htmlspecialchars($unit) ?>" readonly required>

        <label class="form-label w3-text-grey">QUANTITY</label>
        <input class="w3-input w3-border w3-round"
  type="number" name="stock_quantity" id="qty_input" min="1" max="<?= (int) $stock_quantity ?>" value="1" required>

      </div>

      <!-- Footer buttons -->
      <div class="form-footer w3-container w3-border-top w3-padding-16 w3-light-grey">
        <a href="index.php?action=dashboard" class="btn-back w3-button w3-border w3-round">
          &#8592; Back
        </a>
        
        <button type="submit" class="btn-submit w3-button w3-blue w3-round">
          &#10003; Submit request
        </button>
      </div>

    </form>

  </div>
</div>

</body>
</html>