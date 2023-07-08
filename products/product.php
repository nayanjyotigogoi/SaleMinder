<!DOCTYPE html>
<html>
<head>
  <title>Product | SaleMinder</title>
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

    .add-product-btn {
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
  </style>
</head>
<body>
  <div class="container">
    <h1>Products</h1>
    <a href="add_product.php" class="add-product-btn">Add Product</a>
    <table>
      <thead>
        <tr>
          <th>Style No</th>
          <th>Product Name</th>
          <th>Quantity</th>
          <th>Purchasing Price</th>
          <th>MRP</th>
          <th>Selling Price</th>
          <th>Availability</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
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

        // Retrieve data from the database
        $sql = "SELECT * FROM product";
        $result = mysqli_query($conn, $sql);

        // Check if there are any records
        if (mysqli_num_rows($result) > 0) {
          while ($row = mysqli_fetch_assoc($result)) {
            echo '<tr>';
            echo '<td>' . $row['style_no'] . '</td>';
            echo '<td>' . $row['product_name'] . '</td>';
            echo '<td>' . $row['quantity'] . '</td>';
            echo '<td>$' . $row['purchasing_price'] . '</td>';
            echo '<td>$' . $row['mrp'] . '</td>';
            echo '<td>$' . $row['selling_price'] . '</td>';
            echo '<td>' . ($row['quantity'] > 0 ? 'Available' : 'Not available') . '</td>';
            echo '<td>
                    <a href="edit.php">Edit</a> <a href="#">Delete</a>
                    
                  </td>';
            echo '</tr>';
          }
        } else {
          echo '<tr><td colspan="8">No products found.</td></tr>';
        }

        // Close the database connection
        mysqli_close($conn);
        ?>
      </tbody>
    </table>
  </div>
</body>
</html>
