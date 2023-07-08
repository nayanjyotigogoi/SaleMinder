<?php
// Database connection configuration
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'saleminder';

// Create a database connection
$conn = mysqli_connect($host, $username, $password, $database);
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Retrieve form data
  $productName = $_POST['product_name'];
  $quantity = $_POST['quantity'];
  $purchasingPrice = $_POST['purchasing_price'];
  $mrp = $_POST['mrp'];
  $sellingPrice = $_POST['selling_price'];

  // Update the product data in the database
  $sql = "UPDATE product
          SET quantity = $quantity,
              purchasing_price = $purchasingPrice,
              mrp = $mrp,
              selling_price = $sellingPrice
          WHERE product_name = '$productName'";

  if (mysqli_query($conn, $sql)) {
    // Redirect to the product.php page
    header("Location: product.php");
    exit();
  } else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
  }
} else {
  // Retrieve existing product details
  $productId = $_GET['id'];
  $sql = "SELECT * FROM products WHERE id = $productId";
  $result = mysqli_query($conn, $sql);

  if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $productName = $row['product_name'];
    $quantity = $row['quantity'];
    $purchasingPrice = $row['purchasing_price'];
    $mrp = $row['mrp'];
    $sellingPrice = $row['selling_price'];
  } else {
    echo "No product found.";
    exit();
  }
}

// Close the database connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
<head>
  <title>Edit Product - Sales Tracking System</title>
  <style>
    /* CSS styles */
  </style>
</head>
<body>
  <div class="container">
    <h1>Edit Product</h1>
    <div class="form-container">
      <form action="" method="POST">
        <input type="hidden" name="product_name" value="<?php echo $productName; ?>">
        <input type="number" name="quantity" placeholder="Quantity" value="<?php echo $quantity; ?>" required>
        <input type="number" name="purchasing_price" placeholder="Purchasing Price" step="0.01" value="<?php echo $purchasingPrice; ?>" required>
        <input type="number" name="mrp" placeholder="MRP" step="0.01" value="<?php echo $mrp; ?>" required>
        <input type="number" name="selling_price" placeholder="Selling Price" step="0.01" value="<?php echo $sellingPrice; ?>" required>
        <input type="submit" value="Update Product">
      </form>
    </div>
  </div>
</body>
</html>
