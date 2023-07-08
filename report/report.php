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

// Specify the particular day for which you want to generate the report
$targetDate = '2023-07-08'; // Update this with the desired date

// Retrieve the total sales for the specified day
$sqlSales = "SELECT SUM(selling_price * quantity) AS total_sales FROM sales WHERE date = '$targetDate'";
$resultSales = mysqli_query($conn, $sqlSales);
$rowSales = mysqli_fetch_assoc($resultSales);
$totalSales = $rowSales['total_sales'];

// Retrieve the total purchasing cost for the specified day
$sqlPurchases = "SELECT SUM(purchasing_price * quantity) AS total_purchases FROM sales WHERE date = '$targetDate'";
$resultPurchases = mysqli_query($conn, $sqlPurchases);
$rowPurchases = mysqli_fetch_assoc($resultPurchases);
$totalPurchases = $rowPurchases['total_purchases'];

// Calculate the profit for the specified day
$totalProfit = $totalSales - $totalPurchases;

// Display the daily sales report
?>
<!DOCTYPE html>
<html>
<head>
  <title>Daily Sales Report - SaleMinder</title>
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

    p {
      color: #555;
      margin-bottom: 10px;
    }
  </style>
</head>
<body>
  <div class="container">
    <h1>Daily Sales Report - <?php echo $targetDate; ?></h1>
    <p>Total Sales: $<?php echo $totalSales; ?></p>
    <p>Total Purchases: $<?php echo $totalPurchases; ?></p>
    <p>Profit: $<?php echo $totalProfit; ?></p>
  </div>
</body>
</html>
