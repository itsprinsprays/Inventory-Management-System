<?php
require_once "Config/connection.php";
require_once "Controller/TeacherController.php"; 

$controller = new TeacherController($conn);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = [
        'name' => $_POST['name'],
        'contact_number' => $_POST['contact_number'],
        'email' => $_POST['email'],
        'address' => $_POST['address']
    ];

    if ($controller->storeNewTeacher($data)) {
        echo "✅ Teacher added successfully!";
    } else {
        echo "❌ Failed to add teacher.";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Add New Teacher</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #f4f4f9;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }
    .form-container {
      background: #fff;
      padding: 25px;
      border-radius: 8px;
      box-shadow: 0 4px 10px rgba(0,0,0,0.1);
      width: 350px;
    }
    .form-container h2 {
      text-align: center;
      margin-bottom: 20px;
      color: #d32f2f; /* Accent red */
    }
    .form-group {
      margin-bottom: 15px;
    }
    label {
      display: block;
      margin-bottom: 6px;
      font-weight: bold;
    }
    input {
      width: 100%;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 5px;
    }
    button {
      width: 100%;
      padding: 12px;
      background: #d32f2f;
      color: #fff;
      border: none;
      border-radius: 5px;
      font-size: 16px;
      cursor: pointer;
      transition: background 0.3s ease;
    }
    button:hover {
      background: #b71c1c;
    }
  </style>
</head>
<body>
  <div class="form-container">
    <h2>Add New Teacher</h2>
    <form action="TeacherIndex.php" method="POST">
      <div class="form-group">
        <label for="name">Full Name</label>
        <input type="text" id="name" name="name" required>
      </div>
      <div class="form-group">
        <label for="contact_number">Contact Number</label>
        <input type="text" id="contact_number" name="contact_number" required>
      </div>
      <div class="form-group">
        <label for="email">Email Address</label>
        <input type="email" id="email" name="email" required>
      </div>
      <div class="form-group">
        <label for="address">Home Address</label>
        <input type="text" id="address" name="address" required>
      </div>    
      <button type="submit">Save Teacher</button>
    </form>
  </div>
</body>
</html>
