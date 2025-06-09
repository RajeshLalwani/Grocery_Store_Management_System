<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['usemail'])) {
    echo "<p>Please log in to view your cart.</p>";
    exit();
}

$auser = $_SESSION['usemail'];

// Database connection
$con = new mysqli("localhost", "root", "", "grocery store");

// Check connection
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

// Fetch Customer ID
$sqlGetCustomerID = "SELECT c_id FROM customer WHERE c_email = '$auser' LIMIT 1";
$resultCustomerID = $con->query($sqlGetCustomerID);

if ($resultCustomerID->num_rows > 0) {
    $row = $resultCustomerID->fetch_assoc();
    $customerID = $row['c_id'];
} else {
    die("Error: Customer not found.");
}

// Fetch cart items for logged-in user
$sqlCart = "SELECT * FROM orders WHERE c_id = '$customerID'";
$cartResult = $con->query($sqlCart);

$totalAmount = 0; // Variable to hold total amount
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Cart</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f8ff;
            color: #333;
        }

        .cart-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 30px;
        }

        .cart-table th, .cart-table td {
            padding: 10px;
            text-align: center;
            border: 1px solid #ddd;
        }

        .cart-table th {
            background-color: #0077b6;
            color: white;
        }

        .cart-table td a {
            color: #0077b6;
            text-decoration: none;
        }
    </style>
</head>
<body><?php include("index1.php");?>

<?php
// Check if cart has items
if ($cartResult->num_rows > 0) {
    echo '<table class="cart-table">
            <thead>
                <tr>
                    <th>Product Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>';

    // Loop through cart items and display
    while ($row = $cartResult->fetch_assoc()) {
        $itemTotal = $row['order_price'] * $row['order_quantity']; // Calculate item total
        $totalAmount += $itemTotal; // Add to grand total

        echo '<tr>
                <td>' . htmlspecialchars($row['order_detail']) . '</td>
                <td>₹' . htmlspecialchars($row['order_price']) . '</td>
                <td>' . htmlspecialchars($row['order_quantity']) . '</td>
                <td>₹' . $itemTotal . '</td>
                <td><a href="?remove_from_cart=' . $row['o_id'] . '">Remove</a></td>
              </tr>';
    }

    // Grand total row
    echo '<tr>
            <td colspan="3"><strong>Grand Total</strong></td>
            <td><strong>₹' . $totalAmount . '</strong></td>
            <td><a href="checkout1.php">Order Now</a></td>
          </tr>';

    echo '</tbody></table>';
} else {
    echo "<p>Your cart is empty.</p>";
}
?>

</body>
</html>
