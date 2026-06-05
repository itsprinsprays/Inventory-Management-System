<!DOCTYPE html>
<html>
<title>Import XML</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/5/w3.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="/Integrated_Programming/InventorySystem/Inventory-Management-System/Public/XML.css">
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

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

      <li class="logout">
        <a href="index.php?action=logout"><i class="fas fa-right-from-bracket"></i> Log Out</a>
      </li>
    </ul>
  </div>

  <!-- MAIN CONTENT -->
  <div class="page-wrapper">
    <div class="bg-grid"></div>

    <div class="form-card">

      <div class="card-header">
        <div class="header-icon">
          <i class="fas fa-file-import"></i>
        </div>
        <h3>XML Import</h3>
        <p>Select a table and upload your XML file</p>
      </div>

      <?php if (!empty($message)): ?>
        <p class="<?= str_contains($message, 'successfully') ? 'success' : 'error' ?>">
          <?= htmlspecialchars($message) ?>
        </p>
      <?php endif; ?>

      <form action="index.php?action=import-xml" method="POST" enctype="multipart/form-data">
        <div class="form-body">

          <div class="form-field">
            <label class="form-label">Import Into</label>
            <div class="select-wrap">
              <select name="table" class="styled-select">
                <option value="product">Products</option>
                <option value="employee">Employees</option>
              </select>
            </div>
          </div>

          <div class="form-field">
            <label class="form-label">Upload XML File</label>
            <div class="file-wrap">
              <label class="file-label">
                <i class="fas fa-cloud-arrow-up"></i>
                <span id="file-text">Choose a .xml file to upload</span>
                <input type="file" name="xml_file" accept=".xml" required
                  onchange="document.getElementById('file-text').textContent = this.files[0]?.name || 'Choose a .xml file to upload'">
              </label>
            </div>
          </div>

        </div>

        <div class="form-footer">

          <button type="submit" class="btn-submit">
            <i class="fas fa-upload"></i> Import
          </button>
        </div>
      </form>

    </div>
  </div>

</body>
</html>