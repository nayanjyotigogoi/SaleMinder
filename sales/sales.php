 
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
  $styleNo = $_POST['style_no'];
  $productName = $_POST['product_name'];
  $quantity = $_POST['quantity'];
  $sellingPrice = $_POST['selling_price'];
  $purchasingPrice = $_POST['purchasing_price'];
  $mrp = $_POST['mrp'];
  $discount = calculateDiscount($sellingPrice, $mrp); // Calculate the discount
  $date = $_POST['date'];

  // Insert the sale data into the database
  $sql = "INSERT INTO sales (style_no, product_name, quantity, selling_price, purchasing_price, mrp, discount, date)
          VALUES ('$styleNo', '$productName','$quantity', '$sellingPrice','$purchasingPrice', '$mrp', '$discount', '$date')";

  if (mysqli_query($conn, $sql)) {
    echo '<script>alert("Sale added successfully!");</script>';
  } else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
  }
}

// Retrieve existing sales items
$sql = "SELECT * FROM sales";
$result = mysqli_query($conn, $sql);

// Function to calculate the discount
function calculateDiscount($sellingPrice, $mrp) {
  $discount = (($mrp - $sellingPrice) / $mrp) * 100;
  return round($discount, 2); // Round the discount to two decimal places
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Sales - SaleMinder</title>
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

    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 20px;
    }

    th, td {
      padding: 10px;
      text-align: left;
      border-bottom: 1px solid #ccc;
    }

    th {
      background-color: #f2f2f2;
    }

    .add-sale-btn {
      display: block;
      width: 150px;
      margin: 20px auto;
      padding: 10px;
      background-color: #333;
      color: #fff;
      text-align: center;
      text-decoration: none;
      border-radius: 5px;
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
    <h1>Sold Items</h1>
     
    <table>
      <thead>
        <tr>
          <th>Style No</th>
          <th>Product Name</th>
          <th>Quantity</th>
          <th>Selling Price</th>
          <th>Purchasing Price</th>
          <th>MRP</th>
          <th>Discount</th>
          <th>Date</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php
        // Check if there are any sales items
        if (mysqli_num_rows($result) > 0) {
          while ($row = mysqli_fetch_assoc($result)) {
            echo '<tr>';
            echo '<td>' . $row['style_no'] . '</td>';
            echo '<td>' . $row['product_name'] . '</td>';
            echo '<td>' . $row['selling_price'] . '</td>';
            echo '<td>' . $row['mrp'] . '</td>';
            echo '<td>' . $row['discount'] . '%</td>';
            echo '<td>' . $row['date'] . '</td>';
            echo '<td>
                    <a href="#">Edit</a>
                    <a href="#">Delete</a>
                  </td>';
            echo '</tr>';
          }
        } else {
          echo '<tr><td colspan="7">No sales items found.</td></tr>';
        }
        ?>
      </tbody>
    </table>

    <div class="form-container">
      <h2>Add a Sold Item</h2>
      <form action="" method="POST">
        <input type="text" name="style_no" placeholder="Style No" required>
        <input type="text" name="product_name" placeholder="Product Name" required>
        <input type="text" name="quantity" placeholder="Quantity sold" required>
        <input type="text" name="selling_price" placeholder="Selling Price" required>
        <input type="text" name="purchasing_price" placeholder="Purchasing Price" required>
        <input type="text" name="mrp" placeholder="MRP" required>
        <input type="date" name="date" required>
        <input type="submit" value="Add Sale">
      </form>
    </div>
  </div>
</body>
</html>
