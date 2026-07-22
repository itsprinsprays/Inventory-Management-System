<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Receipt #<?= htmlspecialchars($transaction['transaction_id']) ?></title>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
  <style>
    body {
        font-family: 'Courier New', monospace;
        background: #f2f2f2;
    }
    #receipt {
        font-family: 'Courier New', monospace;
        max-width: 400px;
        margin: 40px auto;
        padding: 20px;
        border: 1px dashed #333;
        background: #fff;
    }
    h2 { text-align: center; margin-bottom: 4px; }
    .subtitle { text-align: center; font-size: 0.85rem; color: #555; margin-bottom: 20px; }
    table { width: 100%; border-collapse: collapse; }
    td { padding: 6px 0; vertical-align: top; }
    td.label { color: #555; width: 45%; }
    hr { border: none; border-top: 1px dashed #999; margin: 16px 0; }
    #qrcode {
        display: flex;
        justify-content: center;
        margin: 20px 0;
    }
    #status-msg {
        text-align: center;
        font-family: sans-serif;
        color: #555;
        margin-top: 10px;
    }
  </style>
</head>
<body>

  <div id="receipt">
      <h2>Inventory Management System</h2>
      <p class="subtitle">Stock Transaction Receipt</p>

      <hr>

      <table>
        <tr><td class="label">Transaction ID</td><td>#<?= htmlspecialchars($transaction['transaction_id']) ?></td></tr>
        <tr><td class="label">Product</td><td><?= htmlspecialchars($transaction['product_name']) ?></td></tr>
        <tr><td class="label">Quantity</td><td><?= htmlspecialchars($transaction['stock_quantity']) ?> <?= htmlspecialchars($transaction['unit'] ?? '') ?></td></tr>
        <tr><td class="label">Requested Date</td><td><?= htmlspecialchars($transaction['request_date']) ?></td></tr>
        <tr><td class="label">Confirmed Date</td><td><?= htmlspecialchars($transaction['confirmRequest']) ?></td></tr>
        <tr><td class="label">Employee</td><td><?= htmlspecialchars($transaction['employee_name']) ?></td></tr>
        <tr><td class="label">Employee ID</td><td><?= htmlspecialchars($transaction['employee_id']) ?></td></tr>
        <tr><td class="label">Status</td><td><?= htmlspecialchars($transaction['status']) ?></td></tr>
      </table>

      <hr>

      <div id="qrcode">
        <?php if ($qrImageBase64): ?>
            <img src="data:image/png;base64,<?= $qrImageBase64 ?>" alt="Receipt QR Code" width="180" height="180">
        <?php else: ?>
            <p style="color:red;">QR code could not be generated.</p>
        <?php endif; ?>
      </div>

      <p class="subtitle">Generated on <?= date("F j, Y g:i A") ?></p>
  </div>

  <p id="status-msg">Generating your receipt...</p>

  <script>
    window.onload = function () {
        const receiptEl = document.getElementById("receipt");

        html2canvas(receiptEl, { backgroundColor: "#ffffff", scale: 2 }).then(function (canvas) {
            const link = document.createElement("a");
            link.download = "receipt_<?= htmlspecialchars($transaction['transaction_id']) ?>.png";
            link.href = canvas.toDataURL("image/png");
            link.click();

            document.getElementById("status-msg").textContent = "Receipt downloaded. You may close this tab.";
        }).catch(function (err) {
            document.getElementById("status-msg").textContent = "Failed to generate receipt image.";
            console.error(err);
        });
    };
  </script>

</body>
</html>