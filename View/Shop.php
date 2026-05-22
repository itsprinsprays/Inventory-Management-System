<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="stylesheet" href="../Public/Shop.css">
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Restock Inventory Dashboard</title>


</head>

<body>

  <!-- SIDEBAR -->
  <div class="sidebar">
    <h2>InventorySys</h2>

    <ul>
      <li><a href="#">Dashboard</a></li>
      <li><a href="#">Inventory</a></li>
      <li><a href="#">Transaction History</a></li>
      <li><a href="#">Register Teacher</a></li>
    </ul>
  </div>

  <!-- MAIN -->
  <div class="main">

    <!-- PAGE HEADER -->
    <div class="page-header">
      <div>
        <h1>Dashboard</h1>
        <p>Inventory overview and stock monitoring</p>
      </div>

      <button class="restock-btn">+ Add Product</button>
    </div>

    <!-- DASHBOARD CARDS -->
    <div class="cards">

      <div class="card">
        <h3>Low Stock Items</h3>
        <p>12</p>
      </div>

      <div class="card">
        <h3>Pending Restocks</h3>
        <p>5</p>
      </div>

      <div class="card">
        <h3>Total Products</h3>
        <p>124</p>
      </div>

      <div class="card">
        <h3>Restocked Today</h3>
        <p>34</p>
      </div>

    </div>

    <!-- INVENTORY SECTION -->
    <div class="table-container">

      <div class="table-header">
        <h2>Inventory Overview</h2>

        <input type="text" placeholder="Search product...">
      </div>

      <table>
        <thead>
          <tr>
            <th>Product</th>
            <th>Stock</th>
            <th>Status</th>
          </tr>
        </thead>

       

      </table>
    </div>

  </div>

  <!-- TOAST -->
  <div class="toast" id="toast">
    ✓ Stock Updated Successfully
  </div>

</body>
</html>