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
    $style_no = $_POST['$style_no'];
    $product_name = $_POST['product_name'];
    $amount = $_POST['amount'];
    $quantity = $_POST['quantity'];
    $vendor = $_POST['vendor'];
    $date = $_POST['date'];
  
    // Insert the purchase data into the database
    $sql = "INSERT INTO purchases (style_no, product_name, amount, quantity, vendor, date)
            VALUES ('$style_no', '$product_name', '$amount', $quantity, '$vendor', '$date')";
  
    if (mysqli_query($conn, $sql)) {
      echo '<script>alert("Purchase added successfully!");</script>';
    } else {
      echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
  }
  
  // Retrieve existing purchase items
  $sql = "SELECT * FROM purchases";
  $result = mysqli_query($conn, $sql);
  ?>
  
  <!DOCTYPE html>
  <html>
  <head>
    <title>Purchases - SaleMinder</title>
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
  
      .add-purchase-btn {
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
      <h1>List of Items</h1>
   
      <table>
        <thead>
          <tr>
            <th>Style No</th>
            <th>Product No</th>
            <th>Amount</th>
            <th>Quantity</th>
            <th>Vendor Name</th>
            <th>Date</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php
          // Check if there are any purchase items
          if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
              echo '<tr>';
              echo '<td>' . $row['style_no'] . '</td>';
              echo '<td>' . $row['product_name'] . '</td>';
              echo '<td>' . $row['amount'] . '</td>';
              echo '<td>' . $row['quantity'] . '</td>';
              echo '<td>' . $row['vendor'] . '</td>';
              echo '<td>' . $row['date'] . '</td>';
              echo '<td>
                      <a href="#">Edit</a>
                      <a href="#">Delete</a>
                    </td>';
              echo '</tr>';
            }
          } else {
            echo '<tr><td colspan="7">No purchase items found.</td></tr>';
          }
          ?>
        </tbody>
      </table>
  
      <div class="form-container">
        <h2>Add Purchase</h2>
        <form action="" method="POST">
          <input type="text" name="style_no" placeholder="Style No" required>
          <input type="text" name="product_name" placeholder="product Name" required>
          <input type="text" name="amount" placeholder="Amount" required>
          <input type="number" name="quantity" placeholder="Quantity" required>
          <input type="text" name="vendor" placeholder="Vendor Name" required>
          <input type="date" name="date" required>
          <input type="submit" value="Add Purchase">
        </form>
      </div>
    </div>
  </body>
  </html>
  
