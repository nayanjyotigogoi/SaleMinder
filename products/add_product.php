<?php
$host = "localhost";
$user  = "root";
$password = "";
$db = 'saleminder';

// Create a database connection
$conn = mysqli_connect($host, $user, $password, $db);
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Retrieve form data
  $styleNo = $_POST['style_no'];
  $productName = $_POST['product_name'];
  $quantity = $_POST['quantity'];
  $purchasingPrice = $_POST['purchasing_price'];
  $mrp = $_POST['mrp'];
  $sellingPrice = $_POST['selling_price'];

  // Insert the form data into the database
  $sql = "INSERT INTO product (style_no, product_name, quantity, purchasing_price, mrp, selling_price)
          VALUES ('$styleNo', '$productName', $quantity, $purchasingPrice, $mrp, $sellingPrice)";

  if (mysqli_query($conn, $sql)) {
    echo "Product added successfully!";
  } else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
  }
}

?>
<!DOCTYPE html>
<html>
<head>
  <title>Add Product - Sales Tracking System</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f4f4f4;
      margin: 0;
      padding: 0;
    }

    .container {
      max-width: 800px;
      margin: 0 auto;
      padding: 20px;
    }

    h1 {
      color: #333;
      text-align: center;
    }

    .form-container {
      margin-top: 20px;
    }

    .form-container input[type="text"],
    .form-container input[type="number"] {
      width: 100%;
      padding: 10px;
      margin-bottom: 10px;
    }

    .form-container input[type="submit"] {
      display: block;
      width: 150px;
      margin: 10px auto;
      padding: 10px;
      background-color: #333;
      color: #fff;
      text-align: center;
      text-decoration: none;
      border-radius: 5px;
    }
  </style>
</head>
<body>
  <div class="container">
    <h1>Add Product</h1>
    <div class="form-container">
      <form action="" method="POST">
        <input type="text" name="style_no" placeholder="Style number" required>
        <input type="text" name="product_name" placeholder="Product Name" required>
        <input type="number" name="quantity" placeholder="Quantity" required>
        <input type="number" name="purchasing_price" placeholder="Purchasing Price" step="0.01" required>
        <input type="number" name="mrp" placeholder="MRP" step="0.01" required>
        <input type="number" name="selling_price" placeholder="Selling Price" step="0.01" required>
        <input type="submit" value="Add Product">
      </form>
    </div>
  </div>
</body>
</html>
