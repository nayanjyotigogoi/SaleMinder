<!DOCTYPE html>
<html>
<head>
  <title>Delete Product - Sales Tracking System</title>
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

    .confirmation-message {
      text-align: center;
      margin-top: 50px;
    }

    .confirmation-message p {
      color: #666;
    }

    .confirmation-message a {
      display: inline-block;
      margin-top: 20px;
      padding: 10px 20px;
      background-color: #333;
      color: #fff;
      text-decoration: none;
      border-radius: 5px;
    }
  </style>
</head>
<body>
  <div class="container">
    <h1>Delete Product</h1>
    <div class="confirmation-message">
      <p>Are you sure you want to delete this product?</p>
      <a href="#" onclick="confirmDelete()">Delete</a>
    </div>
  </div>

  <script>
    function confirmDelete() {
      if (confirm("Are you sure you want to delete this product?")) {
        // Send request to delete product
        // You can use AJAX or form submission to send a delete request to the server
        alert("Product deleted successfully.");
      } else {
        // Cancel deletion
        alert("Deletion canceled.");
      }
    }
  </script>
</body>
</html>
