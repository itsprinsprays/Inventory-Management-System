<!DOCTYPE html>
<html>
<title>Import XML</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/5/w3.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
<style>

  * { box-sizing: border-box; }

  body {
    margin: 0;
    font-family: 'Plus Jakarta Sans', sans-serif;
  }

  /* ── SIDEBAR (untouched) ── */
  .sidebar {
    width: 240px;
    height: 100vh;
    background: #0f172a;
    color: white;
    padding: 24px 20px;
    position: fixed;
    left: 0; top: 0;
    display: flex;
    flex-direction: column;
  }
  .sidebar h2 {
    margin: 0 0 36px 0;
    text-align: center;
    color: #38bdf8;
    font-size: 22px;
    font-weight: 700;
  }
  .sidebar ul {
    list-style: none;
    padding: 0; margin: 0;
    display: flex;
    flex-direction: column;
    flex: 1;
  }
  .sidebar ul li { margin: 6px 0; }
  .sidebar ul li a {
    color: #cbd5e1;
    text-decoration: none;
    font-size: 15px;
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 10px 12px;
    border-radius: 8px;
    transition: background 0.2s, color 0.2s, padding-left 0.2s;
  }
  .sidebar ul li a i {
    font-size: 17px;
    width: 20px;
    text-align: center;
    flex-shrink: 0;
  }
  .sidebar ul li a:hover {
    color: #fff;
    background: rgba(255,255,255,0.06);
    padding-left: 16px;
  }
  .sidebar ul li.logout {
    margin-top: auto;
    padding-top: 12px;
    border-top: 1px solid rgba(255,255,255,0.08);
  }
  .sidebar ul li.logout a { color: #f87171; }
  .sidebar ul li.logout a:hover {
    background: rgba(248,113,113,0.08);
    color: #fca5a5;
  }

  /* ── BACKGROUND ── */
  .page-wrapper {
    margin-left: 240px;
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 40px;
    position: relative;
    overflow: hidden;
    background: #0f172a;
  }

  /* animated mesh blobs */
  .page-wrapper::before,
  .page-wrapper::after {
    content: '';
    position: absolute;
    border-radius: 50%;
    filter: blur(80px);
    opacity: 0.25;
    animation: drift 10s ease-in-out infinite alternate;
  }
  .page-wrapper::before {
    width: 500px; height: 500px;
    background: radial-gradient(circle, #38bdf8, #6366f1);
    top: -100px; right: -80px;
  }
  .page-wrapper::after {
    width: 400px; height: 400px;
    background: radial-gradient(circle, #818cf8, #0ea5e9);
    bottom: -80px; left: 60px;
    animation-delay: -4s;
  }

  /* subtle dot grid */
  .bg-grid {
    position: absolute;
    inset: 0;
    background-image: radial-gradient(circle, rgba(148,163,184,0.15) 1px, transparent 1px);
    background-size: 28px 28px;
    pointer-events: none;
  }

  @keyframes drift {
    from { transform: translate(0, 0) scale(1); }
    to   { transform: translate(30px, 20px) scale(1.08); }
  }

  /* ── CARD ── */
  .form-card {
    position: relative;
    z-index: 1;
    width: 100%;
    max-width: 460px;
    background: rgba(255,255,255,0.04);
    border: 1px solid rgba(255,255,255,0.10);
    border-radius: 20px;
    overflow: hidden;
    backdrop-filter: blur(24px);
    -webkit-backdrop-filter: blur(24px);
    box-shadow: 0 32px 64px rgba(0,0,0,0.45), 0 0 0 1px rgba(255,255,255,0.05) inset;
    animation: slideUp 0.5s cubic-bezier(0.22,1,0.36,1) both;
  }

  @keyframes slideUp {
    from { opacity: 0; transform: translateY(28px); }
    to   { opacity: 1; transform: translateY(0); }
  }

  /* card header */
  .card-header {
    padding: 32px 32px 24px;
    text-align: center;
    border-bottom: 1px solid rgba(255,255,255,0.08);
    background: linear-gradient(135deg, rgba(56,189,248,0.12), rgba(99,102,241,0.12));
  }

  .header-icon {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 52px; height: 52px;
    border-radius: 14px;
    background: linear-gradient(135deg, #38bdf8, #6366f1);
    margin-bottom: 14px;
    box-shadow: 0 8px 24px rgba(56,189,248,0.35);
  }
  .header-icon i {
    font-size: 22px;
    color: #fff;
  }

  .card-header h3 {
    margin: 0 0 6px;
    font-size: 20px;
    font-weight: 700;
    color: #f1f5f9;
    letter-spacing: -0.01em;
  }
  .card-header p {
    margin: 0;
    font-size: 13px;
    color: #94a3b8;
  }

  /* form body */
  .form-body {
    padding: 28px 32px 20px;
  }

  .form-label {
    display: block;
    font-size: 11px;
    font-weight: 600;
    color: #64748b;
    letter-spacing: 0.08em;
    margin-bottom: 8px;
    text-transform: uppercase;
  }

  .form-field {
    margin-bottom: 20px;
  }

  .styled-select,
  .styled-file-wrap {
    width: 100%;
    padding: 11px 14px;
    border-radius: 10px;
    border: 1px solid rgba(255,255,255,0.10);
    background: rgba(255,255,255,0.05);
    color: #e2e8f0;
    font-size: 14px;
    font-family: inherit;
    outline: none;
    transition: border-color 0.2s, box-shadow 0.2s;
    appearance: none;
    -webkit-appearance: none;
  }
  .styled-select:focus,
  input[type="file"]:focus {
    border-color: #38bdf8;
    box-shadow: 0 0 0 3px rgba(56,189,248,0.15);
  }
  .styled-select option {
    background: #1e293b;
    color: #e2e8f0;
  }

  /* select arrow */
  .select-wrap {
    position: relative;
  }
  .select-wrap::after {
    content: '\f078';
    font-family: 'Font Awesome 6 Free';
    font-weight: 900;
    font-size: 11px;
    color: #64748b;
    position: absolute;
    right: 14px;
    top: 50%;
    transform: translateY(-50%);
    pointer-events: none;
  }

  /* file input */
  .file-wrap {
    position: relative;
  }
  .file-label {
    display: flex;
    align-items: center;
    gap: 10px;
    width: 100%;
    padding: 11px 14px;
    border-radius: 10px;
    border: 1px dashed rgba(255,255,255,0.15);
    background: rgba(255,255,255,0.03);
    color: #94a3b8;
    font-size: 13px;
    font-family: inherit;
    cursor: pointer;
    transition: border-color 0.2s, background 0.2s;
  }
  .file-label:hover {
    border-color: #38bdf8;
    background: rgba(56,189,248,0.06);
    color: #e2e8f0;
  }
  .file-label i { color: #38bdf8; font-size: 16px; }
  .file-label input[type="file"] {
    position: absolute;
    inset: 0;
    opacity: 0;
    cursor: pointer;
    width: 100%;
  }
  #file-name {
    font-size: 12px;
    color: #38bdf8;
    margin-top: 6px;
    padding-left: 2px;
    min-height: 16px;
  }

  /* messages */
  .success { color: #4ade80; font-size: 13px; padding: 0 32px 4px; }
  .error   { color: #f87171; font-size: 13px; padding: 0 32px 4px; }

  /* footer */
  .form-footer {
    display: flex;
    gap: 10px;
    padding: 20px 32px 28px;
    border-top: 1px solid rgba(255,255,255,0.07);
  }

  .btn-back {
    flex: 1;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 6px;
    padding: 11px 0;
    border-radius: 10px;
    border: 1px solid rgba(255,255,255,0.12);
    background: transparent;
    color: #94a3b8;
    font-size: 14px;
    font-family: inherit;
    font-weight: 500;
    text-decoration: none;
    cursor: pointer;
    transition: background 0.2s, color 0.2s;
  }
  .btn-back:hover {
    background: rgba(255,255,255,0.06);
    color: #e2e8f0;
  }

  .btn-submit {
    flex: 2;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    padding: 11px 0;
    border-radius: 10px;
    border: none;
    background: linear-gradient(135deg, #38bdf8, #6366f1);
    color: #fff;
    font-size: 14px;
    font-family: inherit;
    font-weight: 600;
    cursor: pointer;
    box-shadow: 0 4px 20px rgba(56,189,248,0.30);
    transition: opacity 0.2s, transform 0.15s, box-shadow 0.2s;
  }
  .btn-submit:hover {
    opacity: 0.92;
    transform: translateY(-1px);
    box-shadow: 0 8px 28px rgba(56,189,248,0.40);
  }
  .btn-submit:active {
    transform: translateY(0);
  }

</style>

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
          <a href="index.php?action=inventory" class="btn-back">
            <i class="fas fa-arrow-left"></i> Back
          </a>
          <button type="submit" class="btn-submit">
            <i class="fas fa-upload"></i> Import
          </button>
        </div>
      </form>

    </div>
  </div>

</body>
</html>