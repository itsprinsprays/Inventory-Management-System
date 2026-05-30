<!DOCTYPE html>
<html>
<title>Add Product</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/5/w3.css">
  <link rel="stylesheet" href="/Integrated_Programming/InventorySystem/Inventory-Management-System/View/AddEmployees.css">

<body>

<div class="page-wrapper">
  <div class="form-card w3-card-4">

    <!-- Header -->
    <div class="form-header w3-blue w3-padding-16">
      <h3>Add New Product</h3>
      <p>Fill in the product details below</p>
    </div>

    <?php if (!empty($message)): ?>
      <p class="<?= str_contains($message, 'success') ? 'success' : 'error' ?>">
        <?= htmlspecialchars($message) ?>
      </p>
    <?php endif; ?>

    <!-- Form body -->
    <form action="index.php?action=add-product" method="POST">

      <div class="form-body w3-container">

        <label class="form-label w3-text-grey">PRODUCT NAME</label>
        <input class="w3-input w3-border w3-round w3-margin-bottom"
          type="text" name="product_name" placeholder="e.g. Bondpaper" required>

        <label class="form-label w3-text-grey">DESCRIPTION</label>
        <textarea class="w3-input w3-border w3-round w3-margin-bottom"
          name="description" rows="3" placeholder="e.g. A4 size bond paper"></textarea>

        <label class="form-label w3-text-grey">INITIAL STOCK</label>
        <input class="w3-input w3-border w3-round w3-margin-bottom"
          type="number" name="stock_quantity" min="0" value="0" required>

        <label class="form-label w3-text-grey">UNIT</label>
        <select class="w3-select w3-border w3-round" name="unit" required>
        <option value="" disabled selected>Select unit</option>
        <option value="pcs">Pieces (pcs)</option>
        <option value="box">Box</option>
        <option value="pack">Pack</option>
        <option value="ream">Ream (paper)</option>
        <option value="roll">Roll (tape, art paper)</option>
        <option value="bottle">Bottle (glue, ink)</option>
        <option value="set">Set (geometry set, lab kit)</option>
        <option value="unit">Unit (computer, projector, chair)</option>
        </select>

      </div>

      <!-- Footer buttons -->
      <div class="form-footer w3-container w3-border-top w3-padding-16 w3-light-grey">
        <a href="index.php?action=inventory" class="btn-back w3-button w3-border w3-round">
          &#8592; Back
        </a>
        <button type="submit" class="btn-submit w3-button w3-blue w3-round">
          &#10003; Add Product
        </button>
      </div>

    </form>

  </div>
</div>

</body>
</html>