<!DOCTYPE html>
<html>
<title>Restock Request</title> 
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="/Integrated_Programming/InventorySystem/Inventory-Management-System/Public/Restock.css">
<?php
  $product_id   = $_POST['product_id'] ?? ($_GET['product_id'] ?? '');
  $product_name = $_POST['product_name'] ?? ($_GET['product_name'] ?? '');
  $unit         = $_POST['unit'] ?? ($_GET['unit'] ?? '');
  $quantity     = $_POST['stock_quantity'] ?? 1;
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
    <form action="index.php?action=restock" method="POST">

      <input type="hidden" name="product_id" value="<?= htmlspecialchars($product_id) ?>">
      <input type="hidden" name="employee_id" value="<?= htmlspecialchars($_SESSION['employee_id'] ?? '') ?>">

      <div class="form-body w3-container">

        <label class="form-label w3-text-grey">PRODUCT NAME</label>
        <input class="w3-input w3-border w3-round w3-margin-bottom"
       type="text" name="product_name" 
       value="<?= htmlspecialchars($product_name) ?>" readonly required>

        <label class="form-label w3-text-grey">QUANTITY</label>
        <input class="w3-input w3-border w3-round"
            type="number" name="stock_quantity" min="1" value="1" max="1500" required>

          <label class="form-label w3-text-grey">UNIT</label>
        <input class="w3-input w3-border w3-round w3-margin-bottom"
       type="text" name="unit" 
       value="<?= htmlspecialchars($unit) ?>" readonly required>

    <!-- Message area -->
    <?php if (!empty($message)): ?>
      <div class="form-message">
        <?= $message ?>
      </div>
    <?php endif; ?>


      </div>

      

      <!-- Footer buttons -->
      <div class="form-footer w3-container w3-border-top w3-padding-16 w3-light-grey">
        <a href="index.php?action=inventory" class="btn-back w3-button w3-border w3-round">
          &#8592; Back
        </a>
        <button type="submit" class="btn-submit w3-button w3-blue w3-round">
          &#10003; Restock
        </button>
      </div>

    </form>

  </div>
</div>

</body>
</html>