<!DOCTYPE html>
<html>
<title>Import XML</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/5/w3.css">
<style>
  .page-wrapper { margin-top: 80px; text-align: center; }
  .form-card    { max-width: 480px; margin: auto; border-radius: 12px; overflow: hidden; }
  .form-body    { padding: 24px; text-align: left; }
  .form-label   { font-size: 12px; font-weight: 600; color: #888; letter-spacing: 0.04em; }
  .form-footer  { display: flex; gap: 8px; }
  .btn-back     { flex: 1; text-decoration: none; }
  .btn-submit   { flex: 2; }
  .success { color: green; font-size: 13px; margin: 8px 16px; }
  .error   { color: red;   font-size: 13px; margin: 8px 16px; }
</style>

<body>
<div class="page-wrapper">
  <div class="form-card w3-card-4">

    <div class="w3-blue w3-padding-16" style="text-align:center;">
      <h3 style="margin:0;">XML Import</h3>
      <p style="margin:4px 0 0; font-size:13px; opacity:0.85;">Select a table and upload your XML file</p>
    </div>

    <?php if (!empty($message)): ?>
      <p class="<?= str_contains($message, 'successfully') ? 'success' : 'error' ?>">
        <?= htmlspecialchars($message) ?>
      </p>
    <?php endif; ?>

    <form action="index.php?action=import-xml" method="POST" enctype="multipart/form-data">
      <div class="form-body">

        <label class="form-label">IMPORT INTO</label>
        <select name="table" class="w3-input w3-border w3-round w3-margin-bottom">
          <option value="product">Products</option>
          <option value="employee">Employees</option>
          <option value="user">Users</option>
          <option value="request">Requests</option>
          <option value="transaction">Transactions</option>
        </select>

        <label class="form-label">UPLOAD XML FILE</label>
        <input class="w3-input w3-border w3-round w3-margin-bottom"
          type="file" name="xml_file" accept=".xml" required style="margin-top:8px;">

      </div>

      <div class="form-footer w3-container w3-border-top w3-padding-16 w3-light-grey">
        <a href="index.php?action=inventory" class="btn-back w3-button w3-border w3-round">
          &#8592; Back
        </a>
        <button type="submit" class="btn-submit w3-button w3-blue w3-round">
          &#8679; Import
        </button>
      </div>
    </form>

  </div>
</div>
</body>
</html>